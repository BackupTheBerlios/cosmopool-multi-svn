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
require_once('./obj/forms/formPhotos.php');
require_once('./obj/forms/formUserData.php');
 
class pageUserData extends pageCommon{

    private $passwordform;
    private $photoform;
    private $form;
    private $function;
    private $photos = array();

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
          'house' => $this->user->house),
          'adress2' => array(
          'plz' => $this->user->plz,
          'city' => $this->user->city),
          'country' => $this->user->country,
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
        $this->user->country = $this->form->exportValue('country');
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
        
        $this->user->fetchPreferences();
        $this->user->preferences->delete();
	     $this->user->preferences->registered_message = "2";
	     $this->user->preferences->insert();
      }
      
      // password-form
      
      $this->passwordform = new formUserDataPassword('PasswordForm');

      // Try to validate a form 
      if ($this->passwordform->validate()) {
        $this->user->password = crypt($this->passwordform->exportValue('newpassword'), 'dl');
  
        $this->user->update();
        $session->addParam('password', $this->passwordform->exportValue('newpassword'), 'session');
        $this->addMsg('msg_data_change_success');
      }

      // set main
      
      if($session->getParam('setmain')) {
        $this->user->main_photo = $session->getParam('setmain');
        $this->user->update();
      }

      // delete photos
      
      if($session->getParam('delete')) {
        $photo = new userPhotos;
        $photo->id = $session->getParam('delete');
        $photo->find(true);
        if($photo->user_id == $this->user->id) {
          $photo->delete();
          unlink($config->getSetting('doc_root').'images/uploads/'.$photo->name);
          unlink($config->getSetting('doc_root').'images/uploads/thumb_'.$photo->name);
          
          if($session->getParam('delete') == $this->user->main_photo) {
            $newmain = new userPhotos;
            $newmain->user_id = $this->user->id;
            if($newmain->find(true)) 
              $this->user->main_photo = $newmain->id;
            else 
              $this->user->main_photo = "";
            $this->user->update();
          }
          $this->switchPage('userdata&function=photos&msg=msg_delete_picture');
        }
      }

      // show photos
      
      $photos = new userPhotos;
      $photos->user_id = $this->user->id;
      if($photos->find())
      while($photos->fetch()) {
        $this->photos[] = array("id" => $photos->id, "name" => $photos->name, "obj" => clone $photos);
      }
      
      // photoupload-form
      
      $this->photoform = new formPhotos('PhotoForm');

      // Try to validate a form 
      if ($this->photoform->validate() && $session->getParam('function') == 'photos') {
        $photo = $this->photoform->getElement('photo');
        $file_settings = $photo->getValue();
        $destination = $config->getSetting('doc_root').'images/uploads/';
        $name = time().$file_settings['name'];
        $photo->moveUploadedFile($destination, $name);
        
        $storephoto = new userPhotos;
        $storephoto->name = $name;
        $storephoto->user_id = $this->user->id;
        $storephoto->getFile();
        $storephoto->write(); 
        if(!$this->user->main_photo) {
          $storephoto->find(true);
          $this->user->main_photo = $storephoto->id;
          $this->user->update();
        }

        // if the user has no photo yet, this one is set his main photo

        $this->switchPage('userdata&function=photos&msg=msg_add_picture');
      }

      // function is set
      
      $this->function = 'data';
        
      if($session->getParam('function'))
        $this->function = $session->getParam('function');
    }
    
    private function assignAll() {
      $this->commonAssign();
    
      $tpl_engine = services::getService('tpl');
      $lang = services::getService('lang');

      $tpl_engine->assign('function', $this->function);



      if($this->function == "password") {
        $tpl_engine->assign('text', $lang->getMsg('userdatapassword_text'));
        $tpl_engine->assign('header', $lang->getMsg('userdatapassword_header'));

        // Set formular-templates
        $renderer = new renderer();
  
        // Output the form
        $this->passwordform->accept($renderer);
        $tpl_engine->assign('form', $renderer->toHtml());
      } else if($this->function == "photos") {
        $tpl_engine->assign('photos', $this->photos);
        $tpl_engine->assign('mainphoto', $this->user->main_photo);
        $tpl_engine->assign('text', $lang->getMsg('userdata_photos_text'));
        $tpl_engine->assign('header', $lang->getMsg('userdata_photos_header'));
      
        // Set formular-templates
        $renderer = new renderer();
  
        // Output the form
        $this->photoform->accept($renderer);
        $tpl_engine->assign('form', $renderer->toHtml());
      } else {
        // Set formular-templates
        $renderer = new rendererUserdata();
  
        // Output the form
        $this->form->accept($renderer);
        $tpl_engine->assign('form', $renderer->toHtml());

        $tpl_engine->assign('text', $lang->getMsg('userdata_text_change'));
        $tpl_engine->assign('header', $lang->getMsg('userdata_header_change'));
      }
    }
    
}
?>