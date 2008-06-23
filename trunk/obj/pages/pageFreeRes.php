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
 
class pageFreeRes extends pageCommon{

	 private $user_res = false;
	 private $free_res = false;
	 private $new_pool = false;
	 private $user_new_pool;
	 private $refer = false;

    public function pageFreeRes() {
      $this->pageCommon();
      
      $this->setTemplate('freeres.tpl');

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

      // for redirection

	   if($params->getParam('refer') == 'mysite') {
	     $this->refer = 'mysite';
	   }
	   else
	     $this->refer = 'showpool';

	   // res_free_page
	  
	   $userres = new resFetcher;
      $userres->_order = "name";

      $userres->_user = $this->user->id;

      $userres->search();
      $this->userres = $userres->getAsArray();

	   $user_new_pool = new pools;
	   $user_new_pool->id = $params->getParam('pool_id');

	   if($user_new_pool->find(true)) {

	     $this->user_new_pool = $user_new_pool;
	     
	     $user_new_pools = new poolsUser;
	     $user_new_pools->pool_id = $user_new_pool->id;
	     $user_new_pools->user_id = $this->user->id;
	     $user_new_pools->find(true);
	     if($user_new_pools->res_to_free == 1)
	       $this->new_pool = true;
		
	     if($params->getParam('no_free_submit')) {
	       $user_new_pools->res_to_free = 0;
		    $user_new_pools->update();

          // delete res
          foreach($this->userres as $res) {
            $del_res = new poolsResources;
            $del_res->pool_id = $params->getParam('pool_id');
            $del_res->res_id = $res->id;
            $del_res->find();
            $del_res->delete();
            $freed = true;
          }

          $this->switchPage($this->refer.'&pool_id='.$user_new_pools->pool_id.'&msg=msg_freeres_alldeleted');
		  }
		  else if($params->getParam('res_free_submit')) {
            
          // delete res
          foreach($this->userres as $res) {
            $del_res = new poolsResources;
            $del_res->pool_id = $params->getParam('pool_id');
            $del_res->res_id = $res->id;
            $del_res->find();
            $del_res->delete();
            $freed = true;
          }

		    foreach($_POST as $res_id => $doesnmatter) {
            $free_res = new poolsResources;

            $free_res->res_id = $res_id;
			   $free_res->pool_id = $params->getParam('pool_id');
			   
			   // insert res
			   if($doesnmatter == "check") {
			     if(!$free_res->find()) {
			       $free_res->insert();
                $freed = true;
              }
            }
          }

          // set $msg
          if($freed) {
            $this->switchPage($this->refer.'&pool_id='.$user_new_pools->pool_id.'&msg=msg_free_res_success');
          }
		
		    $user_new_pools->res_to_free = 0;
		    $user_new_pools->update();
		  }
	     else if(is_array($this->userres)) {
	       $this->free_res = true;
	     }
        // user has no resources
	     else {
	       $user_new_pools->res_to_free = 0;
		    $user_new_pools->update();
		    
		    // switch page with msg
		    $this->switchPage('showpool&pool_id='.$user_new_pools->pool_id.'&msg=msg_freeres_nores');
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
		  $tpl_engine->assign('new_pool', $this->new_pool);
		  $tpl_engine->assign('refer', $this->refer);
	   }
	  
      $tpl_engine->assign('header', $lang->getMsg('mysite_freeres_header-1').$this->user_new_pool->name.$lang->getMsg('mysite_freeres_header-2'));
    }
    
}
?>