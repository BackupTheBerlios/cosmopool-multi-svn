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
require_once('./obj/forms/form.php');
require_once './obj/forms/renderer.php';
 
class pageShowPool extends pageCommon{

    private $pool;
    private $cats = array();
    private $threads = array();
    private $not_member;
	 private $res_counter;
	 private $members;
	 private $user_is_waiting = false;
	 private $become_member_form = false;

    public function pageShowPool() {
      $this->pageCommon();
      
      $this->setTemplate('showpool.tpl');

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
      if($pool->get($params->getParam('pool_id'))) {

	   // become member
      if($params->getParam('action') == 'become_member') {
	     if($params->getParam('become_member_submit') || $pool->is_public) {
          $new_membership = new poolsUser;
          $new_membership->user_id = $this->user->id;
          $new_membership->pool_id = $pool->id;
          if(!$pool->is_public) 
            $new_membership->wait = 1;
          else {
            $new_membership->res_to_free = 1;
            $new_membership->wait = 0;
          }
          if($params->getParam('become_member_comments'))
		      $new_membership->comments = $params->getParam('become_member_comments');
          $new_membership->insert();
		  
          // compose E-Mails
          if(!$pool->is_public) {
            $tos = $pool->getAdminEMails();
            foreach($tos as $to)
              $mail->send('new_member', $to, $pool);
          }
          else
            $this->switchPage('mysite');
          
		  }
		  else {
		    $this->become_member_form = true;
		  }
      }
	  
	   // are you waiting?
	   if($pool->isWaiting($this->user->id))
	     $this->user_is_waiting = true;

	   // loose membership
      if($params->getParam('action') == 'no_member') {
        // the last admin can't leave the pool
        if(!$pool->isLastAdmin($this->user->id)) {
          $pool->removeMember($this->user->id);
          $this->addMsg('msg_leave_pool');
        }
        else {
          $this->addMsg('msg_leave_pool_last_admin');
        }
      }

      // build tabledata
	   if($pool->isMember($this->user->id)) {
        $showcats = $categories->getChildren(0);

        foreach($showcats as $cat_id => $cat_name) {
          $show_res = new resFetcher;
          $show_res->_cat = $cat_id;
          $show_res->_pools = array($pool->id);
     
          $rescounter = $show_res->count();
          if($rescounter > 0)
            $this->cats[$cat_id] = array("name" => $cat_name, "count" => $rescounter);
        }
	   }
	   else {
	     if(!$pool->isMember($this->user->id, true))
          $this->not_member = true;
		
		  $res_counter = new poolsResources;
		  $res_counter->pool_id = $pool->id;
		  $this->res_counter = 0;
		  $res_counter->find();
		  while($res_counter->fetch())
		    ++$this->res_counter;
	   }
	  
      // build forum-tabledata
	   if($pool->isMember($this->user->id)) {
        // new/change entry
        if($params->getParam('action') == 'new_entry') {
        
          // formular
          $form = new form('forum_entry');
          $form->addElement('text', 'entryheader', $lang->getMsg('showpool_forum_headline'), array('size' => 30, 'maxlength' => 100));
          $form->addElement('textarea', 'entrytext', $lang->getMsg('home_news_text'), array('rows' => 15, 'cols' => 70));
          $form->addElement('hidden', 'action', 'new_entry');
          $form->addElement('hidden', 'pool_id', $pool->id);
          $form->addElement('hidden', 'thread', $thread->id);
          $form->addElement('submit', 'entrysubmit', $lang->getMsg('home_news_submit'));
          
          $form->addRule('entryheader', $lang->getMsg('showpool_forum_headline_required'), 'required');
          $form->addRule('entrytext', $lang->getMsg('showpool_forum_text_required'), 'required');
          
          // write entry
          if($form->validate()) {
            $new_thread = new forumThreads;
            $new_thread->pool_id = $pool->id;
            $new_thread->title = $form->exportValue('entryheader');
            $new_thread->act_date = time();
            $new_thread->insert();
            $new_thread->find(true);

            $new_entry = new forumEntries;
            $new_entry->thread_id = $new_thread->id;
            $new_entry->text = $form->exportValue('entrytext');
            $new_entry->user_id = $this->user->id;
            $new_entry->date = $new_thread->act_date;

            $new_entry->insert();

            $this->switchPage('showpool&pool_id='.$pool->id.'&msg=msg_forum_entry_made');
          }
          
          $this->form = $form;
        
        }      
      
        $showthreads = new forumThreads;
        $showthreads->pool_id = $pool->id;
        $showthreads->find();

        while($showthreads->fetch()) {
          $showthreads->fetchLastEntry();
          $showthreads->last_entry->fetchUser();        
        
          $this->threads[] = array("id" => $showthreads->id, 
                                   "title" => $showthreads->title,
                                   "act_date" => date('j. n. y, H:i', $showthreads->last_entry->date).
                                                 ' '.$lang->getMsg('showpool_forum_lastentry_by').' '.
                                                 '<a href="./index.php?page=showmember&pool_id='.$pool->id.'&showmember='.$showthreads->last_entry->user->id.'" target="ueber" onclick="javascript: window.open(this,\'ueber\',\'width=350,height=300,scrollbars=yes\');">'.$showthreads->last_entry->user->name.'</a>'); 
        }
	   }

	   // build userlist
	  
	   // assotiativ array with object and detail-flag
	   if($pool->isMember($this->user->id) && $pool->is_public != 1){
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
			  
			  $member = array("obj" => $pool_users->user, "detail" => ($pool_users->user->id == $detail_id), "count" => $count, "admin" => $pool->isAdmin($pool_users->user->id));
			  $members[] = $member;
			  ++$count;
			}
		  }
		  $this->members = $members;
		}
	   }
        
      $this->pool = $pool;
      }
      else
        $this->switchPage('mysite');
    }
    
    private function assignAll() {
      $this->commonAssign();
      
      $tpl_engine = services::getService('tpl');
      $lang = services::getService('lang');

      $tpl_engine->assign('header', $this->pool->name);
	  $tpl_engine->assign('user_is_waiting', $this->user_is_waiting);
	  $tpl_engine->assign('become_member_form', $this->become_member_form);
      
      if($this->form) {
      $renderer = new renderer;
      $this->form->accept($renderer);
      $tpl_engine->assign('form', $renderer->toHtml());}

	  if(is_array($this->members))
	    $tpl_engine->assign('members', $this->members);
	  
      if($this->not_member)
        $tpl_engine->assign('not_member', true);
        
      $tpl_engine->assign('pool', $this->pool);
	  if($this->pool->isMember($this->user->id)) {
        $tpl_engine->assign('cats', $this->cats);
        $tpl_engine->assign('threads', $this->threads);
     }
	  else {
        if(!$this->pool->isMember($this->user->id, true))
		  $tpl_engine->assign('no_apply', true);
	    $tpl_engine->assign('res_counter', $this->res_counter);
	  }
    }
    
}
?>