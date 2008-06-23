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
 
class pageInvite extends pageCommon{

    private $emails = array();

    public function pageInvite() {
      $this->pageCommon();
      
      $this->setTemplate('invite.tpl');

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
      $categories = services::getService('cats');
	   
      // Try to validate a form 

      if ($this->analyseEmails()) {
      
        // send emails
        
        foreach($this->emails as $email) {
	       $mail = services::getService('mail');

          $mail->send('invite', $email, $this->user, $params->getParam('message'));
        }
        
        // redirect and message
        
        $this->switchPage('invite&msg=msg_invite_success');
      }
      else if ($params->getParam('submit')) {
        $this->addMsg('msg_no_real_emails');
      }
    }
    
    private function analyseEmails() {
      $params = services::getService('pageParams');

      if($params->getParam('emails')) {
        $one_at_least = false;
        
        // seperate them
        
        $emails = explode(',', $params->getParam('emails'));
        
        foreach($emails as $email) {
          $email = trim($email, " \t\n\r");
          
          if(check_email($email)) {
            $this->emails[] = $email;
            $one_at_least = true;
          }
        }
        
        // prove them
        if($one_at_least)
          return true;
        else
          return false;
      }
      else
        return false;
    }
    
    private function assignAll() {
      $this->commonAssign();
      
      $tpl_engine = services::getService('tpl');
      $lang = services::getService('lang');
      $params = services::getService('pageParams');

      $tpl_engine->assign('header', $lang->getMsg('invite_header'));
    }
    
}
?>