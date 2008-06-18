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
require_once('./obj/forms/formSearch.php');
require_once('./obj/forms/rendererSearch.php');

class pageCommon extends page {

    private $headerlinks = array();
    private $footerlinks = array();
    private $todo;
    private $searchform;
    private $pools_get;
    private $pools = array();

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
      
      // build subcategories for "myresources"
      
      if(isset($this->user)) {
      // borrowed res are shown
      $this->borrowed_res = $this->user->getBorrowedRes();

      // waiting res are shown
      $this->res_offers = $this->user->getWaitingRes();

      $this->toDoList();

      // fetch users pools
      $my_pools_ids = $this->user->getPoolIDs();
      foreach($my_pools_ids as $pool_id) {
        $userpool = new pools;
        $userpool->id = $pool_id;
        $userpool->find(true);
        $this->pools_get .= $pool_id.'a';
        $this->pools[] = array($pool_id, $userpool->name);
      }
      
      // Instantiate the HTML_QuickForm object
      $this->searchform = new formSearch('SearchForm', $this->pools_get);

      // Try to validate a form 
      if ($this->searchform->validate() && ($session->getParam('searchsubmit') == 'submitted')) {

        $search_res = new resFetcher;
        $search_res->_cat = $this->searchform->exportValue('cat');
        $search_res->_search_string = $this->searchform->exportValue('searchstring');
        $search_res->_pools = $this->searchform->exportValue('searchwhere');
        $pool_ids = array();
        $pools_get = $this->searchform->exportValue('searchwhere');

        if($search_res->count() < 1)
          $this->addMsg('msg_no_results');
        else {
          $this->switchPage('resbrowser&cat='.$this->searchform->exportValue('cat').
                            '&searchwhere='.$pools_get.
                            '&searchstring='.$this->searchform->exportValue('searchstring'));
        }
      }}
    }
    
    public function toDoList() {
      // ToDo-list
      if(isset($this->user)) {
        $newmsgs = 0;
        
        $msgs = new pm;
        $msgs->recipient_id = $this->user->id;
        $msgs->recipient_delete = 0;
        $msgs->is_read = 0;
        if($msgs->find()) 
        while($msgs->fetch()) {
          ++$newmsgs;
        }
      
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
        if($wait_user || $wait_res_count > 0 || $newmsgs > 0) {
          $todo = array();
          if($wait_res_count > 0)
            $todo['res'] = $wait_res_count;
          if($newmsgs > 0)
            $todo['msgs'] = $newmsgs;
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
      
      if(isset($this->user)) {
      if($this->searchform) {
        // Output the form
        $renderer = new rendererSearch;

        $this->searchform->accept($renderer);
        $tpl_engine->assign('searchform', $renderer->toHtml());
      }

      // footerlinks
      if($this->user->login) {
        $tpl_engine->assign('footerlinks', true);
        $tpl_engine->assign('todo', $this->todo);
      }

      $tpl_engine->assign('res_offers', $this->res_offers);
      $tpl_engine->assign('borrowed_res', $this->borrowed_res);
      }

      // msg
      $tpl_engine->assign('msg', $this->getMsg());

      // commonstuff
      $tpl_engine->assign('html_title', $lang->getMsg('html_title'));
    }
    
}
?>