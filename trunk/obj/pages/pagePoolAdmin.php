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
 * res browser
 */
 
require_once('./obj/pages/pageCommon.php');
 
class pagePoolAdmin extends pageCommon{

    private $form;
    private $header;
    private $new_admins;
    private $kick_user;
    private $pool;
    private $waiting_user;
	 private $really_kick_member;
	 private $really_add_admin;
	 private $members;
	 private $admins;
	 private $lastadmin = false;
	 private $reallydelpool = false;

    public function pagePoolAdmin() {
      $this->pageCommon();
      
      $this->setTemplate('pooladmin.tpl');

      $this->process();

      // output
      $this->assignAll();
      $this->display();
    }
    
    private function process() {
      $this->commonProcess();
    
      $mail = services::getService('mail');
      $config = services::getService('config');
      $lang = services::getService('lang');
      $params = services::getService('pageParams');
      $categories = services::getService('cats');

      $pool = new pools;
      $pool->get($params->getParam("pool_id"));
      if($pool->isAdmin($this->user->id)){

	   $this->header = $pool->name. $lang->getMsg('pooladmin_header');

	   // build userlist
	  
	   // assotiativ array with object and detail-flag
	   if($pool->isMember($this->user->id)){
	     $members = array();
		
		  $pool_users = new poolsUser;
		  $pool_users->pool_id = $pool->id;
		  $pool_users->wait = 0;
		
	  	  if($pool_users->find()) {
		    $detail_id = $params->getParam('showmember');
		
		    $count = 1;
		    while($pool_users->fetch()) {
			   if($pool_users->user_id != $this->user->id) {
		        $pool_users->fetchUser();
			  
			     $member = array("obj" => $pool_users->user, "detail" => ($pool_users->user->id == $detail_id), "count" => $count);
			     $members[] = $member;
			     ++$count;
			   }
		    }
		    $this->members = $members;
		  }
	   }
	   // build adminlist
	  
	   // assotiativ array with object and detail-flag
	   if($pool->isAdmin($this->user->id)){
	     $admins = array();
		
		  $pool_admins = new poolsAdmin;
		  $pool_admins->pool_id = $pool->id;
		  $pool_admins->wait = 0;
		
		  if($pool_admins->find()) {
		    $detail_id = $params->getParam('showadmin');
		
		    $count1 = 1;
		    while($pool_admins->fetch()) {
			   if($pool_admins->user_id != $this->user->id) {
		        $pool_admins->fetchUser();
			  
			     $admin = array("obj" => $pool_admins->user, "detail" => ($pool_admins->user->id == $detail_id), "count" => $count1);
			     $admins[] = $admin;
			     ++$count1;
			   }
		    }
		    $this->admins = $admins;
		  }
	   }

      // form processing

      // Waiting User

      $wait_users = new poolsUser;
      $wait_users->pool_id = $pool->id;
      $wait_users->wait = "1";
      
      if($wait_users->find()) {
        $waiting_user = array();
        while($wait_users->fetch()) {
          $waiting_user[] = $wait_users->user_id;
        }
      }

      // refuse_user-form
      if($params->getParam('user_refuse_submit') != false) {
        foreach($waiting_user as $user_id) {
		  if($params->getParam($user_id) == 1) {
            $refuse_user = new poolsUser;

            // user is refused
            $refuse_user->user_id = $user_id;
            $refuse_user->pool_id = $pool->id;
            $refuse_user->find();
            $refuse_user->delete();
            $refused = TRUE;
            $refused_mail = new user;
            $refused_mail->get($refuse_user->user_id);
            $mail->send("user_refused", $refused_mail, $pool);
          }
        }
        // set $msg
        if($refused)
          $this->addMsg('msg_refuse_user_success');
      }

      // accept_user-form
      if($params->getParam('user_accept_submit') != false) {
        foreach($waiting_user as $user_id) {
		  if($params->getParam($user_id) == 1) {
            $accept_user = new poolsUser;
    
            // user is accepted
            $accept_user->user_id = $user_id;
            $accept_user->pool_id = $pool->id;
            $accept_user->find(true);
            $accept_user->wait = 0;
			$accept_user->res_to_free = 1;
            $accept_user->update();
            $accepted = TRUE;
            $accepted_mail = new user;
            $accepted_mail->get($user_id);
			
            $mail->send("user_accepted", $accepted_mail, $pool);
          }
        }
		
        // set $msg
        if($accepted) {
          $this->addMsg('msg_accept_user_success');
        }
      }

      // add Admin
      if($params->getParam('action') == 'new_admin') {
	    if($params->getParam('really') == 'yes') {
          $pool->addAdmin($params->getParam('user'));
          $this->addMsg('msg_add_admin');
		  $new_admin = new user;
		  $new_admin->get($params->getParam('user'));
		  $mail->send('new_admin', $new_admin, $pool);
		}
		else {
		  $add_admin = new user;
		  $add_admin->get($params->getParam('user'));
		  $this->really_add_admin = $add_admin;
		}
      }

      // kick_member
      if($params->getParam('action') == 'kick_user') {
	    if($params->getParam('really') == 'yes') {
          $pool->removeMember($params->getParam('user'));
          $this->addMsg('msg_kick_member');
		  $kicker = new user;
		  $kicker->get($params->getParam('user'));
		  $mail->send('kick_member', $kicker, $pool);
		}
		else {
		  $kick_member = new user;
		  $kick_member->get($params->getParam('user'));
		  $this->really_kick_member = $kick_member;
		}
      }

      $pool_new_admins = new poolsUser;
      $pool_new_admins->pool_id = $pool->id;
      $pool_new_admins->wait = 0;
      $pool_new_admins->find();
        
      $new_admins = array();
      while($pool_new_admins->fetch()) {
        if(!$pool->isAdmin($pool_new_admins->user_id)) {
          $pool_new_admin = new user;
          $pool_new_admin->get($pool_new_admins->user_id);
          $new_admins[] = clone $pool_new_admin;
        }
      }
      $this->new_admins = $new_admins;

      $pool_kick_nutzis = new poolsUser;
      $pool_kick_nutzis->pool_id = $pool->id;
      $pool_kick_nutzis->wait = 0;
      $pool_kick_nutzis->find(); 
      $kick_user = array();
      while($pool_kick_nutzis->fetch()) {
        if(!$pool->isAdmin($pool_kick_nutzis->user_id)) {
          $pool_kick_nutzi = new user;
          $pool_kick_nutzi->get($pool_kick_nutzis->user_id);
          $kick_user[] = clone $pool_kick_nutzi;
        }
      }    
      $this->kick_user = $kick_user;
      
      // Waiting User

      $wait_users = new poolsUser;
      $wait_users->pool_id = $pool->id;
      $wait_users->wait = "1";
      
      if($wait_users->find()) {
        $waiting_user = array();
        while($wait_users->fetch()) {
          $wait_user = new user;
          $wait_user->get($wait_users->user_id);
          $waiting_user[] = array("obj" => clone $wait_user, "comments" => $wait_users->comments);
        }
        $this->waiting_user = $waiting_user;
      }
      
      // delete pool
      
      if($pool->isLastAdmin($this->user->id))
        $this->lastadmin = true;
      if($params->getParam('action') == 'delpool') {
        $this->reallydelpool = true;
        if($params->getParam('really') == 'yes') {
        
          $pool->deleteAll();
          $this->switchPage('mysite&msg=msg_delpool_success');
        
        }
      }

      $this->pool = $pool;
    }}
    
    private function assignAll() {
      $this->commonAssign();
      
      $tpl_engine = services::getService('tpl');
      $lang = services::getService('lang');

	  if(is_array($this->members))
	    $tpl_engine->assign('members', $this->members);
	  if(is_array($this->admins))
	    $tpl_engine->assign('admins', $this->admins);
	  
      $tpl_engine->assign('header', $this->header);
      if(isset($this->pool))
        $tpl_engine->assign('pool', $this->pool);
      if(is_array($this->new_admins))
        $tpl_engine->assign('new_admins', $this->new_admins);
      if(is_array($this->waiting_user))
        $tpl_engine->assign('waiting_user', $this->waiting_user);
      if(is_array($this->kick_user))
        $tpl_engine->assign('kick_user', $this->kick_user);
	   $tpl_engine->assign('really_kick_member', $this->really_kick_member);
	   $tpl_engine->assign('lastadmin', $this->lastadmin);
	   $tpl_engine->assign('reallydelpool', $this->reallydelpool);
	   $tpl_engine->assign('really_add_admin', $this->really_add_admin);
    }
    
}
?>