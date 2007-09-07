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
 
class pageShowMember extends pageCommon{

    private $pool;
    private $member;
    private $not_member;

    public function pageShowMember() {
      $this->pageCommon();
      
      $this->setTemplate('showmember.tpl');
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
      $mail = services::getService('mail');
      $categories = services::getService('cats');
      
      $pool = new pools;
      $pool->get($params->getParam('pool_id'));

	   // build userlist
	   
	   // assotiativ array with object and detail-flag
	   
		$pool_users = new poolsUser;
      $pool_users->user_id = $params->getParam('showmember');
		
		if($pool_users->find(true)) {
		  $pool_users->fetchUser();
			  
		  $member = array("obj" => $pool_users->user, "detail" => ($pool_users->user->id == $detail_id), "count" => $count, "admin" => $pool->isAdmin($pool_users->user->id));
		  $this->member = $member;
		  $this->member['obj']->getPhoto();
		}
        
      $this->pool = $pool;
    }
    
    private function assignAll() {
      $this->commonAssign();
      
      $tpl_engine = services::getService('tpl');
      $lang = services::getService('lang');

      //$tpl_engine->assign('public', !($this->user->inMine($this->member['obj']->id)));
      $tpl_engine->assign('public', true);
      if($this->member['obj']->photo) 
        $tpl_engine->assign('photo', $this->member['obj']->photo);
      $tpl_engine->assign('header', $this->member['obj']->name);
      $tpl_engine->assign('member', $this->member);
    }
    
}
?>