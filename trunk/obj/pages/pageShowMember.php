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
 
require_once('./obj/pages/page.php');
 
class pageShowMember extends page{

    private $pool;
    private $member;
    private $not_member;

    public function pageShowMember() {
      echo $this->page();
      
      $this->setTemplate('showmember.tpl');
      $this->process();

      // output
      $this->assignAll();
      $this->display();
    }
    
    private function process() {
    
      $config = services::getService('config');
      $lang = services::getService('lang');
      $params = services::getService('pageParams');
      $mail = services::getService('mail');
      $categories = services::getService('cats');
      
      $pool = new pools;
      $pool->get($params->getParam('pool_id'));

	   // build userlist
	   
	   // assotiativ array with object and detail-flag
	   if($pool->isMember($this->user->id) && $pool->id != 1){
	   
		  $pool_users = new poolsUser;
		  $pool_users->pool_id = $pool->id;
        $pool_users->user_id = $params->getParam('showmember');
		
		  if($pool_users->find(true)) {
		    if($pool_users->user_id != $this->user->id) {
		      $pool_users->fetchUser();
			  
			   $member = array("obj" => $pool_users->user, "detail" => ($pool_users->user->id == $detail_id), "count" => $count, "admin" => $pool->isAdmin($pool_users->user->id));
			 }
		  }
		  $this->member = $member;
		}
        
      $this->pool = $pool;
    }
    
    private function assignAll() {
      
      $tpl_engine = services::getService('tpl');
      $lang = services::getService('lang');

      $tpl_engine->assign('member', $this->member);
    }
    
}
?>