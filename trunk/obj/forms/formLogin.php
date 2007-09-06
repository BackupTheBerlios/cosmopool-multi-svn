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
require_once './obj/forms/rendererLogin.php';

class formLogin extends form {

    // constructor
    function formLogin($name) {
      $lang = services::getService('lang');
    
      $this->form($name);

      // Add some elements to the form
      $this->addElement('text', 'login', $lang->getMsg('form_login'), array('size' => 18, 'maxlength' => 50, 'class' => 'inputtext'));
      $this->addElement('password', 'loginpassword', $lang->getMsg('form_password'), array('size' => 18, 'maxlength' => 50, 'class' => 'inputtext'));
      $this->addElement('submit', 'submit', $lang->getMsg('form_submit_login'), array('class' => 'inputsubmit'));

      // Define filters and validation rules
      $this->addRule('login', $lang->getMsg('required_name'), 'required');
      $this->addRule('loginpassword', $lang->getMsg('required_password'), 'required');
    }
    
}

?>