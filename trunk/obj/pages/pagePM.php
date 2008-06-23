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
 
require_once('./obj/forms/formPM.php');
require_once('./obj/pages/pageCommon.php');

class pagePM extends pageCommon{

    private $function;
    private $inbox = array();
    private $sent = array();
    private $msgform;
    private $recipient;
    private $adressbook = array();
    private $view;

    public function pagePM() {
      $this->pageCommon();
      
      $this->setTemplate('pm.tpl');

      $this->process();

      // output
      $this->assignAll();
      $this->display();
    }
    
    private function process() {
   
	   $mail = services::getService('mail');
      $config = services::getService('config');
      $lang = services::getService('lang');
      $params = services::getService('pageParams');
      $categories = services::getService('cats');

      // function is set
      
      if($params->getParam('function'))
        $this->function = $params->getParam('function');
      else
        $this->function = 'inbox';

      // view

      if($this->function == 'view') {
        $view = new pm;
        $view->id = $params->getParam('msg_id');
        $view->find(true);
        if(($view->recipient_id == $this->user->id) || ($view->sender_id == $this->user->id)) {
          if($view->recipient_id == $this->user->id) {
            $view->fetchSender();
              $delete = clone $view;
              $delete->delete();
              $view->is_read = 1;
              $view->insert();
          }
          if($view->sender_id == $this->user->id)
            $view->fetchRecipient();
          $this->view = clone $view;
        }
      }
      
      // inbox

      if($this->function == 'inbox') {
      
        // delete      
      
        if($params->getParam('delete')) {
          $msg = new pm;
          $msg->id = $params->getParam('delete');
          $msg->find();$msg->fetch();
          if($msg->recipient_id == $this->user->id) {
              $delete = clone $msg;
              $delete->delete();
              $msg->recipient_delete = 1;
              $msg->insert();
              $this->addMsg('msg_msg_deleted');
          }
        }
        
        // mark read      
      
        if($params->getParam('markread')) {
          $msg = new pm;
          $msg->id = $params->getParam('markread');
          $msg->find();$msg->fetch();
          if($msg->recipient_id == $this->user->id) {
              $delete = clone $msg;
              $delete->delete();
              $msg->is_read = 1;
              $msg->insert();
          }
        }
        
        // get list
      
        $msgs = new pm;
        $msgs->recipient_id = $this->user->id;
        $msgs->recipient_delete = 0;
        $msgs->orderBy('is_read ASC, date DESC');
        
        $msgs->find();
        while($msgs->fetch()) {
          $msgs->fetchSender();
          $this->inbox[] = clone $msgs;
        }
      }

      // sent

      if($this->function == 'sent') {
        $msgs = new pm;
        $msgs->sender_id = $this->user->id;
        $msgs->orderBy('date DESC');
        
        $msgs->find();
        while($msgs->fetch()) {
          $msgs->fetchRecipient();
          $this->sent[] = clone $msgs;
        }
      }

      if($this->function == 'new') {
        if($params->getParam('recipient')) {
      
        $this->msgform = new formPM('msgform', $params->getParam('recipient'));
        $recipient = new user;
        $recipient->id = $params->getParam('recipient');
        $recipient->find(true);
        $this->recipient = clone $recipient;
        
        if($params->getParam('answer')) {
          $answer = new pm;
          $answer->id = $params->getParam('answer');
          $answer->find(true);
          
          $this->msgform->setDefaults(array(
          'title' => 'Re: '.$answer->title));
        }
        
        if($this->msgform->validate()) {
          $msg = new pm;
          $msg->recipient_id = $this->msgform->exportValue('recipient');
          $msg->sender_id = $this->user->id;
          
          $msg->title = $this->msgform->exportValue('title');
          $msg->body = $this->msgform->exportValue('body');
          
          $msg->is_in_draft = 0;
          $msg->is_read = 0;
          $msg->recipient_delete = 0;
          $msg->sender_delete = 0;
          
          $msg->date = time();
          
          $msg->insert();
          
          $addr = new adressbook;
          $addr->recipient_id = $this->msgform->exportValue('recipient');
          $addr->sender_id = $this->user->id;
          if(!$addr->find())
            $addr->insert();
          
          // send email
          
          $recipient = new user;
          $recipient->id = $this->msgform->exportValue('recipient');
          $recipient->find(true);
          
          $mail->send('new_pm', $recipient, $this->user);
          
          $this->switchPage('pm&function=inbox&msg=msg_msg_sent');
        }}
        else {
          if($params->getParam('delete')) {
            $delete = new adressbook;
            $delete->sender_id = $this->user->id;
            $delete->recipient_id = $params->getParam('delete');
            $delete->delete();
            $this->addMsg('msg_contact_deleted');
          }
        
          $addr = new adressbook;
          $addr->sender_id = $this->user->id;
          
          $addr->find();
          while($addr->fetch()) {
            $addr->fetchRecipient();
            $this->adressbook[] = clone $addr;
          }
        }
      }
      $this->commonProcess();
    }
    
    private function assignAll() {
      $this->commonAssign();
      
      $lang = services::getService('lang');
      $tpl_engine = services::getService('tpl');
      $params = services::getService('pageParams');

      $tpl_engine->assign('header', $lang->getMsg('pm_header'));

      if($this->function == 'new') {
        if($params->getParam('recipient')) {
        $tpl_engine->assign('header', $lang->getMsg('pm_header_write'));

        // Output the form
        $renderer = new renderer;

        $this->msgform->accept($renderer);
        $tpl_engine->assign('msgform', $renderer->toHtml());
        $tpl_engine->assign('recipient', $this->recipient);
        }
        else
        $tpl_engine->assign('adressbook', $this->adressbook);
      }

      $tpl_engine->assign('function', $this->function);
      $tpl_engine->assign('inbox', $this->inbox);
      $tpl_engine->assign('view', $this->view);
      $tpl_engine->assign('sent', $this->sent);
    }
    
}
?>