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
require_once('./obj/forms/formRegister.php');
 
class pageRegister extends pageCommon{

    private $form1;
    private $form2;

    public function pageRegister() {
      $this->pageCommon();

      $this->setTemplate('register.tpl');

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
      
      $this->addHeaderLink('home', $lang->getMsg('mailinglist_backlink'), 'left');
      
/*      if($_POST['submit2']) {
        $this->form2 = new formRegister2('UserForm2',
                       $_POST['login'],
                       $_POST['password'],
                       $_POST['email']);
      }
      else {*/
      
      $this->form1 = new formRegister1('UserForm1', $this->user->login);

      // Try to validate a form 
      if ($this->form1->validate()) {
/*        $this->form2 = new formRegister2('UserForm2',
                       $this->form1->exportValue('name'),
                       $this->form1->exportValue('password'),
                       $this->form1->exportValue('email'));
        $email = $this->form2->getElement('emailpublic');
        $email->setChecked(true);*/
        $this->user = new user;
        $this->user->name = $this->form1->exportValue('name');
        $this->user->password = crypt($this->form1->exportValue('password'), 'dl');
        $this->user->email = $this->form1->exportValue('email');
        $this->user->insert();
        
        // registermessage on mypage
        $pref = new userPreferences;
        $pref->user_id = $this->user->id;
        $pref->welcome_message = 1;
        $pref->registered_message = 1;
        $pref->insert();
        
        // add user to Pool
        if(!$this->user->isMember(1))
          $this->user->addMembership(1);
        
        $session->addParam('msg', 'msg_register_success', 'page');
        $mail->send("registered", $this->user, $this->user, $this->form1->exportValue('password'));
        $this->switchPage('home');
      }//}
      
/*      if(isset($this->form2)) {

      if ($this->form2->validate()) {

        $this->user->phone = $this->form2->exportValue('phone');
        $adress1 = $this->form2->getElementValue('adress1');
        $this->user->street = $adress1['street'];
        $this->user->house = $adress1['house'];
        $this->user->country = $adress1['country'];
        $adress2 = $this->form2->getElementValue('adress2');
        $this->user->plz = $adress2['plz'];
        $this->user->city = $adress2['city'];
        $this->user->description = $this->form2->exportValue('description');
        if($this->form2->exportValue('emailpublic'))
          $this->user->email_public = $this->form2->exportValue('emailpublic');      
        else
          $this->user->email_public = 0;
        if($this->form2->exportValue('phonepublic'))
          $this->user->phone_public = $this->form2->exportValue('phonepublic');      
        else
          $this->user->phone_public = 0;
        if($this->form2->exportValue('adresspublic'))
          $this->user->plz_city_public = $this->form2->exportValue('adresspublic');      
        else
          $this->user->plz_city_public = 0;
  
        // if phone_public, phone is nessesary
        if(($this->user->phone_public == 1) && (strlen($this->user->phone) < 1))
          $this->user->phone_public = 0;
      
        
      }}*/
    }
    
    private function assignAll() {
      $this->commonAssign();
    
      $tpl_engine = services::getService('tpl');
      $lang = services::getService('lang');

      // Set formular-templates
      $renderer = new rendererUserdata();
  
      // Output the form
/*      if(isset($this->form2)) {
        $this->form2->accept($renderer);
        $tpl_engine->assign('text', $lang->getMsg('register_text2'));
        $tpl_engine->assign('header', $lang->getMsg('register_header2'));
      }
      else {*/
        $this->form1->accept($renderer);
        $tpl_engine->assign('text', $lang->getMsg('register_text1'));
        $tpl_engine->assign('header', $lang->getMsg('register_header1'));
      //}
      $tpl_engine->assign('form', $renderer->toHtml());
    }
    
}
?>