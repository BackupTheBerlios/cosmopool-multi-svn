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
 * base page-class, not to be instanciated
 */
 
require_once('./obj/pages/page.php');

class pageCommon extends page {

    private $headerlinks = array();
    private $footerlinks = array();
    private $todo;

    public function pageCommon() {
      $this->page();
    }
    
    public function addHeaderLink($page, $label, $direction) {
      $this->headerlinks[$direction][$page] = $label;
    }
    
    public function commonProcess() {
      $lang = services::getService('lang');
      $session = services::getService('pageParams');

      if(!isset($this->user) && $session->getParam('page') != 'register' && $session->getParam('page') != 'static') {
        $session->addParam('msg', 'msg_login_first', 'page');
        
        $this->switchPage('home');
      }
      // headerlinks
      if($this->user->login) {
        $this->addHeaderLink('logout', $lang->getMsg('link_logout'), 'right');
        $this->addHeaderLink('mysite', $lang->getMsg('link_mysite'), 'left');
      }
      
      $this->toDoList();
    }
    
    public function toDoList() {
      // ToDo-list
      if(isset($this->user)) {
        $wait_res_count = 0;
        $waiting_res = $this->user->getWaitingRes();
        if(is_array($waiting_res))
          foreach($waiting_res as $res) {
            ++$wait_res_count;
          }
            
        $waiting_user = new poolsUser;
        $wait_user_count = array();
  
        $waiting_user->wait = 1;
		  $wait_user = false;
        if($waiting_user->find()) {
          while($waiting_user->fetch()) {
            $user_admin = new poolsAdmin;
            $user_admin->pool_id = $waiting_user->pool_id;
            $user_admin->user_id = $this->user->id;
            if($user_admin->find()) {
			     $wait_user = true;
              ++$wait_user_count["$waiting_user->pool_id"]["count"];
              $wait_user_count["$waiting_user->pool_id"]["pool"] = new pools;
              $wait_user_count["$waiting_user->pool_id"]["pool"]->get($waiting_user->pool_id);
            }
          }
        }
        if($wait_user || $wait_res_count > 0) {
          $todo = array();
          if($wait_res_count > 0)
            $todo['res'] = $wait_res_count;
          if($wait_user)
            $todo['user'] = $wait_user_count;
          $this->todo = $todo;
        }
        else
          $this->todo = false;
      }
    }
    
    public function commonAssign() {
      // linkboxes

      $tpl_engine = services::getService('tpl');
      $lang = services::getService('lang');

      // headerlinks
      $tpl_engine->assign('headerlinks', $this->headerlinks);

      // footerlinks
      if($this->user->login) {
        $tpl_engine->assign('footerlinks', true);
        $tpl_engine->assign('todo', $this->todo);
      }

      // msg
      $tpl_engine->assign('msg', $this->getMsg());

      // commonstuff
      $tpl_engine->assign('html_title', $lang->getMsg('html_title'));
    }
    
}
?>