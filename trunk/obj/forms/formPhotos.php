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
 * Login Form
 */

require_once './obj/forms/form.php';
require_once './obj/forms/renderer.php';

class formPhotos extends form {

    // constructor
    function formPhotos($name) {
      $lang = services::getService('lang');
    
      $this->form($name);

      // Add some elements to the form
      $this->addElement('hidden', 'function', "photos");
      $this->addElement('file', 'photo', $lang->getMsg('userdata_photos_form_file'));
      $this->addElement('submit', 'submit', $lang->getMsg('userdata_submit'));

      // Define filters and validation rules
      $this->registerRule('passcommon', 'callback', 'passwordCommon');
      $this->registerRule('passprooven', 'callback', 'proovePassword');

      /*$this->addRule('oldpassword', $lang->getMsg('userdata_password_required'), 'required');
      $this->addRule('oldpassword', $lang->getMsg('userdata_password_incorrect'), 'passprooven', false);
      
      $this->addRule('newpassword', $lang->getMsg('userdata_password_inlist'), 'passcommon', false);
      $this->addRule('newpassword', $lang->getMsg('userdata_password_tooshort'), 'minlength', 6);
      $this->addRule('newpassword', $lang->getMsg('userdata_password_required'), 'required');
      $this->addRule(array('newpassword', 'newpassword2'), $lang->getMsg('userdata_passwords_differ'), 'compare');*/
    }
    
}

?>