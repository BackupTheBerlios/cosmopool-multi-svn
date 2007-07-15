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
 * homepage
 */
 
require_once('./obj/pages/pageCommon.php');
require_once('./obj/forms/formUserDataPassword.php');
 
class pageUserDataPassword extends pageCommon{

    private $form;

    public function pageUserDataPassword() {
      $this->pageCommon();

      $this->setTemplate('userdatapassword.tpl');

      $this->process();
      
      // output
      $this->assignAll();
      $this->display();
    }
    
    private function process() {
      $this->commonProcess();
    
      $config = services::getService('config');
      $lang = services::getService('lang');
      $session = services::getService('pageParams');
      $mail = services::getService('mail');
      
      $this->form = new formUserDataPassword('PasswordForm');

      // Try to validate a form 
      if ($this->form->validate()) {
        $this->user->password = crypt($this->form->exportValue('newpassword'), 'dl');
  
        $this->user->update();
        $session->addParam('password', $this->form->exportValue('newpassword'), 'session');
        $this->switchPage('mysite&msg=msg_data_change_success');
      }
    }
    
    private function assignAll() {
      $this->commonAssign();
    
      $tpl_engine = services::getService('tpl');
      $lang = services::getService('lang');

      // Set formular-templates
      $renderer = new renderer();
  
      // Output the form
      $this->form->accept($renderer);
      $tpl_engine->assign('form', $renderer->toHtml());

      if($this->user->login) {
        $tpl_engine->assign('text', $lang->getMsg('userdatapassword_text'));
        $tpl_engine->assign('header', $lang->getMsg('userdatapassword_header'));
      }
      else
        $tpl_engine->assign('header', $lang->getMsg('userdata_header_register'));
    }
    
}
?>