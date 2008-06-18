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

class formPoolData extends form {

    // constructor
    function formPoolData($name) {
      $lang = services::getService('lang');
      $params = services::getService('pageParams');
      $cats = services::getService('cats');
    
      $this->form($name);

      // Add some elements to the form
      $this->addElement('text', 'poolname', $lang->getMsg('pooldata_form_name'), array('size' => 30, 'maxlength' => 50));
      $this->addElement('textarea', 'pooldesc', $lang->getMsg('pooldata_form_description'), array('rows' => 8, 'cols' => 50));
      $this->addElement('text', 'poolarea', $lang->getMsg('pooldata_form_area'), array('size' => 30, 'maxlength' => 50));

      /*$is_located = array();
      $is_located[] = HTML_QuickForm::createElement('radio', null, null, $lang->getMsg('pooldata_form_is_located_no'), 0);
      $is_located[] = HTML_QuickForm::createElement('radio', null, null, $lang->getMsg('pooldata_form_is_located_yes'), 1);
      $this->addGroup($is_located, 'is_located', $lang->getMsg('pooldata_form_is_located'), '<br>');*/
      $countries = services::getService('countries');
      $this->addElement('select', 'poolcountry', $lang->getMsg('pooldata_form_country'), $countries->getAsArray());
      $adress[] = &HTML_QuickForm::createElement('text', 'plz1', null, array('size' => 2, 'maxlength' => 2));
      $adress[] = &HTML_QuickForm::createElement('text', 'plz2', null, array('size' => 3, 'maxlength' => 3));
      $adress[] = &HTML_QuickForm::createElement('text', 'city', null, array('size' => 20, 'maxlength' => 30));
      $this->addGroup($adress, 'pooladress', $lang->getMsg('userdata_adress2'), '&nbsp;');

      $this->addElement('select', 'is_public', $lang->getMsg('pooldata_form_is_public'), array("0"=>$lang->getMsg('pooldata_form_is_located_no'),"1"=>$lang->getMsg('pooldata_form_is_located_yes')));

      if($params->getParam('pool_id')) 
        $this->addElement('hidden', 'pool_id', $params->getParam('pool_id'));
      $this->addElement('submit', 'submit', $lang->getMsg('pooldata_form_submit'));

      // Define filters and validation rules
      $this->registerRule('securehtml', 'callback', 'secureHtml');

      $this->addRule('poolname', $lang->getMsg('pooldata_form_namenecessary'), 'required');
      $this->addRule('pooldesc', $lang->getMsg('pooldata_form_descnecessary'), 'required');
      $this->addRule('pooldesc', $lang->getMsg('pooldata_form_securehtml'), 'securehtml');
      $this->addRule('poolarea', $lang->getMsg('pooldata_form_areanecessary'), 'required');

      $adressrules['plz1'][] = array($lang->getMsg('userdata_plz_numeric'), 'numeric');
      $adressrules['plz2'][] = array($lang->getMsg('userdata_plz_numeric'), 'numeric');

      $this->addGroupRule('pooladress', $adressrules);
    }
    
	 function freezeForm() {
	   $this->removeElement('submit');
 	   $this->freeze();
	 }
    
}

?>