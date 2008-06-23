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
 
class pageMyPools extends pageCommon{

    private $mypoolstable = array(); // array
    private $mypoolstable_threecol = false; // bool; set true, if the user is admin of some pool
	 private $user_res = false;
	 private $free_res = false;
	 private $user_new_pool;

    public function pageMyPools() {
      $this->pageCommon();
      
      $this->setTemplate('mypools.tpl');

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
    }
    
    private function assignAll() {
      $this->commonAssign();
      
      $tpl_engine = services::getService('tpl');
      $lang = services::getService('lang');

      $tpl_engine->assign('header', $lang->getMsg('mysite_mypools_header'));
     
      $tpl_engine->assign('mypoolstable_thirdcol', $this->mypoolstable_thirdcol);
      $tpl_engine->assign('mypoolstable', $this->mypoolstable);
    }
    
}
?>