<?php

/*
    Copyright 2004, 2005 Robert Griesel

    This file is part of NutziGems.

    NutziGems is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    NutziGems is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with NutziGems; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/
/**
 * my site
 */

require_once('./obj/pages/pageCommon.php');
 
class pageMySite extends pageCommon{

	 private $borrowed;
    private $mypoolstable = array(); // array
    private $mypoolstable_threecol = false; // bool; set true, if the user is admin of some pool
    private $new_pool;
    private $welcome_msg = true;
    private $registered_msg = false;

    public function pageMySite() {
      $this->pageCommon();
      
      $this->setTemplate('mysite.tpl');

      $this->process();

      // output
      $this->assignAll();
      $this->display();
    }
    
    private function process() {
      $this->commonProcess();
    
      $config = services::getService('config');
      $lang = services::getService('lang');
	   $params = services::getService('pageParams');
	   
	   // release resources
	   
	   if($this->user->hasResources()) {
	   
	   // release no resources-function
	   
	   if($params->getParam('function') == "freenone") {
	     $relnone = new poolsUser;
	     $relnone->pool_id = $params->getParam('freenone_pool_id');
	     $relnone->user_id = $this->user->id;
	     $relnone->find(true);
	     $relnone->res_to_free = 0;
	     $relnone->update();
	   }

	   $newpools = new poolsUser;
	   $newpools->res_to_free = 1;
	   $newpools->user_id = $this->user->id;
	   
	   if($params->getParam('new_pool')) {
	     $newpool = new pools;
	     $newpool->id = $params->getParam('new_pool');
	     $newpool->find(true);
	     $this->new_pool = clone $newpool;
	   }
	   else if($newpools->find(true)) {
	     $newpools->fetchPool();
	     $this->new_pool = clone $newpools->pool;
	   }
	   
	   }
	   
	   $this->user->fetchPreferences();

	   // registered msg
	   
	   if($params->getParam('function') == "noregistered") {
	     $this->user->preferences->delete();
	     $this->user->preferences->registered_message = "2";
	     $this->user->preferences->insert();
	   }
	   
	   if($this->user->preferences->registered_message === "1")
	     $this->registered_msg = true;
	   // welcome msg
	   
	   if($params->getParam('function') == "nowelcome") {
	     $this->user->preferences->delete();
	     $this->user->preferences->welcome_message = "2";
	     $this->user->preferences->insert();
	   }
	   
	   if($this->user->preferences->welcome_message === "2")
	     $this->welcome_msg = false;
	   
      // the table with users pools is generated

      // fetch "Pool"
      $pools_pool = new pools;
      $pools_pool->id = 1;
      $pools_pool->find(true);

      if($pools_pool->isAdmin($this->user->id)) {
        $this->mypoolstable_thirdcol = true;
        
        $this->mypoolstable[] = array("id" => $pools_pool->id, 
                                      "name" => $pools_pool->name, 
                                      "area" => $pools_pool->area,
                                      "links" => '<a href="./index.php?page=pooldata&pool_id='.$pools->id.'">'.$lang->getMsg('mysite_poolsadmintable_changedatalink').'</a> | <a href="./index.php?page=pooladmin&pool_id='.$pools->id.'">'.$lang->getMsg('mysite_poolsadmintable_adminlink').'</a>');
      }
      else {
        $this->mypoolstable[] = array("id" => $pools_pool->id, 
                                      "name" => $pools_pool->name, 
                                      "area" => $pools_pool->area,);
      }
        
      // fetch all other pools
      $pools = new poolsFetcher;
      $pools->_user = $this->user->id;

      $pools->_order = "name";

      $pools->search();

      while($pools->fetch()) {
      if($pools->id != 1) {
        if($pools->isAdmin($this->user->id)) {
          $this->mypoolstable_thirdcol = true;

          $this->mypoolstable[] = array("id" => $pools->id, 
                                        "name" => $pools->name, 
                                        "area" => $pools->area,
                                        "links" => '<a href="./index.php?page=pooldata&pool_id='.$pools->id.'">'.$lang->getMsg('mysite_poolsadmintable_changedatalink').'</a> | <a href="./index.php?page=pooladmin&pool_id='.$pools->id.'">'.$lang->getMsg('mysite_poolsadmintable_adminlink').'</a>');
        }
        else {
          $this->mypoolstable[] = array("id" => $pools->id, 
                                        "name" => $pools->name, 
                                        "area" => $pools->area);
        }
      }}

	   // fetch all borrowed resources
	   
	   $borrowed = new resBorrowed;
	   $borrowed->user_id = $this->user->id;
	  
	   if($borrowed->find()) {
	     $this->borrowed = array();
		  while($borrowed->fetch()){
		    $borrowed->fetchRes();
		    $borrowed->res->fetchUser();
		    $this->borrowed[] = clone $borrowed->res;
		  }
	   }
    }
    
    private function assignAll() {
      $this->commonAssign();
      
      $tpl_engine = services::getService('tpl');
      $lang = services::getService('lang');

      $tpl_engine->assign('header', $lang->getMsg('mysite_header'));
     
      $tpl_engine->assign('links', $this->links);
      $tpl_engine->assign('mypoolstable_thirdcol', $this->mypoolstable_thirdcol);
      $tpl_engine->assign('mypoolstable', $this->mypoolstable);
      $tpl_engine->assign('links', $this->links);
      $tpl_engine->assign('welcome_msg', $this->welcome_msg);
      $tpl_engine->assign('registered_msg', $this->registered_msg);
      
      if(is_object($this->new_pool))
        $tpl_engine->assign('new_pool', $this->new_pool);
      
	   if(is_array($this->borrowed))
	     $tpl_engine->assign('borrowed', $this->borrowed);
    }
    
}
?>