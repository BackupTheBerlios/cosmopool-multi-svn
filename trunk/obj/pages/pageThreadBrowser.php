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
 
class pageThreadBrowser extends pageCommon{

    private $pool;
    private $not_member;
    private $thread;
    private $entries;
    private $form;

    public function pageThreadBrowser() {
      $this->pageCommon();
      
      $this->setTemplate('threadbrowser.tpl');

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
      
      $pool = new pools;
      $pool->get($params->getParam('pool_id'));
      $this->pool = $pool;
      
	   if($pool->isMember($this->user->id)) {

        $thread = new forumThreads;
        $thread->id = $params->getParam('thread');
        $thread->find();
        $thread->fetch();
        
        // new/change entry
        if($params->getParam('action') == 'new_entry') {
        
          // formular
          $form = new form('forum_entry');
          $form->addElement('textarea', 'entrytext', $lang->getMsg('home_news_text'), array('rows' => 15, 'cols' => 70));
          $form->addElement('hidden', 'action', 'new_entry');
          $form->addElement('hidden', 'pool_id', $pool->id);
          $form->addElement('hidden', 'thread', $thread->id);
          $form->addElement('submit', 'entrysubmit', $lang->getMsg('home_news_submit'));
          
          $form->addRule('entrytext', $lang->getMsg('showpool_forum_text_required'), 'required');
          
          // write entry
          if($form->validate()) {
            $new_entry = new forumEntries;
            $new_entry->thread_id = $thread->id;
            $new_entry->text = $form->exportValue('entrytext');
            $new_entry->user_id = $this->user->id;
            $new_entry->date = time();

            $threads = clone $thread;
            $threads->act_date = $new_entry->date;
           	$thread->delete();
            $threads->insert();

            $new_entry->insert();

            $this->switchPage('threadbrowser&pool_id='.$pool->id.'&thread='.$threads->id.'&msg=msg_forum_entry_made');
          }
          
          $this->form = $form;
        
        }      
      
        // build forum-tabledata

        $this->thread = $thread;
        
        // fetch entries
        
        $entries = new forumEntries;
        $entries->thread_id = $thread->id;
        
        $entries->find();
        
        while($entries->fetch()) {
          $entries->fetchUser();
          $this->entries[$entries->id] = clone $entries;        
        }
	   }
      else
        $this->switchPage('showpool&pool_id='.$pool->id.'&msg=msg_nice_try');
    }
    
    private function assignAll() {
      $this->commonAssign();
      
      $tpl_engine = services::getService('tpl');
      $lang = services::getService('lang');

      $tpl_engine->assign('header', $this->thread->title);

      // Output the form
      if($this->form) {
      $renderer = new renderer;
      $this->form->accept($renderer);
      $tpl_engine->assign('form', $renderer->toHtml());}

      $tpl_engine->assign('pool', $this->pool);
      $tpl_engine->assign('thread', $this->thread);
      $tpl_engine->assign('entries', $this->entries);
    }
    
}
?>