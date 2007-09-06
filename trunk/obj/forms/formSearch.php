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

class formSearch extends form {

    // constructor
    function formSearch($name) {
      $lang = services::getService('lang');
      $categories = services::getService('cats');
      $params = services::getService('pageParams');
      
      $cats = $categories->getAll();
    
      $this->form($name);

      // Add some elements to the form
      $this->addElement('text', 'searchstring', $lang->getMsg('search_form_searchstring'), array('size' => 30, 'maxlength' => 50));
      $this->addElement('select', 'cat', $lang->getMsg('search_form_category'), $cats, array('onchange' => 'search_cat_change_new(this.value)'));
      $this->addElement('select', 'searchwhere', $lang->getMsg('search_form_where'));

      /*// fetch additional attributes e.g. form-fields for chosen category
      
      if($params->getParam('cat')) {
        $this->setDefaults(array('cat' => $params->getParam('cat'))); 

        $cat = $params->getParam('cat');
        
        $this->addElement('hidden', 'cat', $cat);
        
        $attributes = new attributes;
        $attributes->category_id = $cat;
        if($attributes->find()) {
          while($attributes->fetch()) {
          
            if($attributes->type == "string") {
              if($attributes->name == "isbn") {
                $this->addElement('text', 'search_'.$attributes->name, $lang->getMsg('resdata_form_'.$attributes->name), array('size' => 30, 'maxlength' => 255));
              }
              else
                $this->addElement('text', 'search_'.$attributes->name, $lang->getMsg('resdata_form_'.$attributes->name), array('size' => 30, 'maxlength' => 255));
            }
            
            if($attributes->type == "select") {
              $keys = new attributesSelectKeys;
              $keys->attribute_id = $attributes->id;
              $keys->find();
              
              $options = array();
              $options[0] = "----";
              while($keys->fetch())
                $options[$keys->key] = $lang->getMsg('resdata_form_select_'.$keys->value); 
              
              $select_elements = array();
              for($i = 1; $attributes->amount >= $i; ++$i)
                $select_elements[] = &HTML_QuickForm::createElement('select', $i, null, $options);
              $this->addGroup($select_elements, 'search_'.$attributes->name, $lang->getMsg('resdata_form_'.$attributes->name), '&nbsp;');
            }

          }
        }
      }*/

      $this->addElement('submit', 'submit', $lang->getMsg('search_form_submit'));
    }
    
    function setPools($array,$string) {
      $lang = services::getService('lang');
      $el = $this->getElement('searchwhere');
      $el->addOption($lang->getMsg('search_option_all_pools'), $string);
      foreach($array as $userpool) {
        $el->addOption($userpool[1], $userpool[0]);
      }
    }
    
}

?>