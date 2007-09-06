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
require_once './obj/forms/rendererUserdata.php';

class formUserData extends form {

    // constructor
    function formUserData($name, $login) {
      $lang = services::getService('lang');
    
      $this->form($name);

      // Add some elements to the form
      $this->addElement('text', 'email', $lang->getMsg('userdata_email'), array('size' => 30, 'maxlength' => 50));
      $this->addElement('text', 'email2', $lang->getMsg('userdata_email2'), array('size' => 30, 'maxlength' => 50));
      $this->addElement('checkbox', 'emailpublic', $lang->getMsg('userdata_emailpublic'));
      $this->addElement('text', 'phone', $lang->getMsg('userdata_phone'), array('size' => 20, 'maxlength' => 20));
      $this->addElement('checkbox', 'phonepublic', $lang->getMsg('userdata_phonepublic'));
      $adress1 = array();
      $adress1[] = &HTML_QuickForm::createElement('text', 'street', null, array('size' => 20, 'maxlength' => 50));
      $adress1[] = &HTML_QuickForm::createElement('text', 'house', null, array('size' => 3, 'maxlength' => 10));
      $this->addGroup($adress1, 'adress1', $lang->getMsg('userdata_adress1'), '&nbsp;');
      $adress2 = array();
      $adress2[] = &HTML_QuickForm::createElement('text', 'plz', null, array('size' => 5, 'maxlength' => 5));
      $adress2[] = &HTML_QuickForm::createElement('text', 'city', null, array('size' => 20, 'maxlength' => 30));
      $this->addGroup($adress2, 'adress2', $lang->getMsg('userdata_adress2'), '&nbsp;');

      $this->addElement('select', 'country', $lang->getMsg('userdata_country'), array("DE"=>$lang->getMsg('country_DE'), "AT"=>$lang->getMsg('country_AT'), "CH"=>$lang->getMsg('country_CH'), "GR"=>$lang->getMsg('country_GR'), "US"=>$lang->getMsg('country_US'), "GB"=>$lang->getMsg('country_GB')));
      $this->addElement('checkbox', 'adresspublic', $lang->getMsg('userdata_adresspublic'));
      $this->addElement('textarea', 'description', $lang->getMsg('userdata_description'), array('rows' => 5, 'cols' => 50));

      // Define filters and validation rules
      $this->addRule('login', $lang->getMsg('userdata_name_required'), 'required');
      $this->addRule('password', $lang->getMsg('userdata_password_required'), 'required');
      $this->addElement('submit', 'submit', $lang->getMsg('userdata_submit'));
      
      // Define filters and validation rules
      if(!$login) {
        $this->registerRule('userunique', 'callback', 'usernameUnique');
        $this->registerRule('emailunique', 'callback', 'emailUnique');
        $this->addRule('name', $lang->getMsg('userdata_nameuniqueness'), 'userunique', false);
        $this->addRule('email', $lang->getMsg('userdata_emailuniqueness'), 'emailunique', false);
        $this->addRule('name', $lang->getMsg('userdata_name_required'), 'required');
        $this->registerRule('passcommon', 'callback', 'passwordCommon');
        $this->addRule('password', $lang->getMsg('userdata_password_inlist'), 'passcommon', false);
        $this->addRule('password', $lang->getMsg('userdata_password_tooshort'), 'minlength', 6);
        $this->addRule('password', $lang->getMsg('userdata_password_required'), 'required');
        $this->addRule(array('password', 'password2'), $lang->getMsg('userdata_passwords_differ'), 'compare');
      }

      $this->addRule('email', $lang->getMsg('userdata_email_necessary'), 'required');
      $this->addRule(array('email', 'email2'), $lang->getMsg('userdata_emails_differ'), 'compare');
      $this->addRule('email', $lang->getMsg('userdata_not_an_email'), 'email');
      
      $adress1rules['street'][] = array($lang->getMsg('userdata_street_necessary'), 'required');
      $adress1rules['house'][] = array($lang->getMsg('userdata_house_necessary'), 'required');
      $adress2rules['plz'][] = array($lang->getMsg('userdata_plz_necessary'), 'required');
      $adress2rules['plz'][] = array($lang->getMsg('userdata_plz_numeric'), 'numeric');
      $adress2rules['city'][] = array($lang->getMsg('userdata_city_necessary'), 'required');

      $this->addGroupRule('adress1', $adress1rules);
      $this->addGroupRule('adress2', $adress2rules);
    }
    
}

?>