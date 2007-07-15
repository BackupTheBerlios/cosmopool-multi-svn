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
	 private $user_res = false;
	 private $free_res = false;
	 private $user_new_pool;

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

	   // res_free_page
	  
	   $user_new_pools = new poolsUser;
	   $user_new_pools->user_id = $this->user->id;
	   $user_new_pools->res_to_free = 1;
	   $userres = new resFetcher;
      $userres->_order = "name";

      $userres->_user = $this->user->id;

      $userres->search();
      $this->userres = $userres->getAsArray();
	  
	   if($user_new_pools->find(true)) {
	     $user_new_pools->fetchPool();
	     $this->user_new_pool = $user_new_pools->pool;
		
	     if($params->getParam('no_free_submit')) {
	       $user_new_pools->res_to_free = 0;
		   $user_new_pools->update();
		  }
		  else if($params->getParam('res_free_submit')) {
		    foreach($_POST as $res_id => $doesnmatter) {
            $free_res = new poolsResources;

            // delete res
            $free_res->res_id = $res_id;
			   $free_res->pool_id = $params->getParam('pool');
			   if(!$free_res->find(true)) {
			     $free_res->insert();
              $freed = true;
            }
          }
  
          // set $msg
          if($freed)
            $this->addMsg('msg_free_res_success');
		
		    $user_new_pools->res_to_free = 0;
		    $user_new_pools->update();
		  }
	     else if(is_array($this->userres)) {
	       $this->free_res = true;
	     }
	     else {
	       $user_new_pools->res_to_free = 0;
		    $user_new_pools->update();
	     }
	   }

      // the table with users pools is generated

      // fetch "Pool"
      $pools_pool = new pools;
      $pools_pool->name = "Pool";
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
      if($pools->name != "Pool") {
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

	   if($this->free_res) {
	     $tpl_engine->assign('header', $lang->getMsg('mysite_freeres_header'));
		  $tpl_engine->assign('userres', $this->userres);
		  $tpl_engine->assign('user_new_pool', $this->user_new_pool);
	   }
	  
      $tpl_engine->assign('header', $lang->getMsg('mysite_header'));
     
      $tpl_engine->assign('links', $this->links);
      $tpl_engine->assign('mypoolstable_thirdcol', $this->mypoolstable_thirdcol);
      $tpl_engine->assign('mypoolstable', $this->mypoolstable);
      $tpl_engine->assign('links', $this->links);
      
	   if(is_array($this->borrowed))
	     $tpl_engine->assign('borrowed', $this->borrowed);
    }
    
}
?>