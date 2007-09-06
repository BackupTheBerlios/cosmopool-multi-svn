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
require_once('./obj/forms/formUserData.php');
 
class pageUserData extends pageCommon{

    private $form;

    public function pageUserData() {
      $this->pageCommon();

      $this->setTemplate('userdata.tpl');

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
      
      $this->form = new formUserData('UserForm', $this->user->login);

      // defaults
      $this->form->setDefaults(array(
          'name' => $this->user->email,
          'email' => $this->user->email,
          'email2' => $this->user->email,
          'emailpublic' => $this->user->email_public,
          'phone' => $this->user->phone,
          'phonepublic' => $this->user->phone_public,
          'adress1' => array(
          'street' => $this->user->street,
          'country' => $this->user->country,
          'house' => $this->user->house),
          'adress2' => array(
          'plz' => $this->user->plz,
          'city' => $this->user->city),
          'description' => $this->user->description,
          'adresspublic' => $this->user->plz_city_public
      ));

      // Try to validate a form 
      if ($this->form->validate()) {
        $this->user->email = $this->form->exportValue('email');
        $this->user->phone = $this->form->exportValue('phone');
        $adress1 = $this->form->getElementValue('adress1');
        $this->user->street = $adress1['street'];
        $this->user->house = $adress1['house'];
        $this->user->country = $adress1['country'];
        $adress2 = $this->form->getElementValue('adress2');
        $this->user->plz = $adress2['plz'];
        $this->user->city = $adress2['city'];
        $this->user->description = $this->form->exportValue('description');
        if($this->form->exportValue('emailpublic'))
          $this->user->email_public = $this->form->exportValue('emailpublic');      
        else
          $this->user->email_public = 0;
        if($this->form->exportValue('phonepublic'))
          $this->user->phone_public = $this->form->exportValue('phonepublic');      
        else
          $this->user->phone_public = 0;
        if($this->form->exportValue('adresspublic'))
          $this->user->plz_city_public = $this->form->exportValue('adresspublic');      
        else
          $this->user->plz_city_public = 0;
  
        // if phone_public, phone is nessesary
        if(($this->user->phone_public == 1) && (strlen($this->user->phone) < 1))
          $this->user->phone_public = 0;
      
        $this->user->update();

        // add user to Pool
        if(!$this->user->isMember(1))
          $this->user->addMembership(1);
        
        $this->addMsg('msg_data_change_success');
      }
    }
    
    private function assignAll() {
      $this->commonAssign();
    
      $tpl_engine = services::getService('tpl');
      $lang = services::getService('lang');

      // Set formular-templates
      $renderer = new rendererUserdata();
  
      // Output the form
      $this->form->accept($renderer);
      $tpl_engine->assign('form', $renderer->toHtml());

      $tpl_engine->assign('text', $lang->getMsg('userdata_text_change'));
      $tpl_engine->assign('header', $lang->getMsg('userdata_header_change'));
    }
    
}
?>