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

class formResData extends form {

    // constructor
    function formResData($name, $res_id = 0, $user) {
      $lang = services::getService('lang');
      $params = services::getService('pageParams');
      $cats = services::getService('cats');
    
      $this->form($name);

      if($params->getParam('res_id')) {
        $this->addElement('hidden', 'res_id', $params->getParam('res_id'));
        
        // Categories
        $this->addElement('select', 'resdata_cat', $lang->getMsg('resdata_form_category'), $cats->getAll(), array('onchange' => 'resdata_cat_change(this.value, document.ResDataForm.res_id.value)'));
      }
      else
        $this->addElement('select', 'resdata_cat', $lang->getMsg('resdata_form_category'), $cats->getAll(), array('onchange' => 'resdata_cat_change_new(this.value)'));


      $this->addElement('text', 'name', $lang->getMsg('resdata_form_name'), array('size' => 40, 'maxlength' => 255));
      $this->addElement('textarea', 'description', $lang->getMsg('resdata_form_description'), array('rows' => 7, 'cols' => 40));
      
      // fetch additional attributes e.g. form-fields for chosen category
      
      if($params->getParam('cat')) {
        $cat = $params->getParam('cat');
        
        $this->addElement('hidden', 'cat', $cat);
        
        $attributes = new attributes;
        $attributes->category_id = $cat;
        if($attributes->find()) {
          while($attributes->fetch()) {
          
            if($attributes->type == "string") {
              if($attributes->name == "isbn") {
                $this->addElement('text', 'resdata_'.$attributes->name, $lang->getMsg('resdata_form_'.$attributes->name), array('size' => 30, 'maxlength' => 255));
                $this->addElement('submit', 'resdata_'.$attributes->name.'_submit', $lang->getMsg('resdata_form_'.$attributes->name.'_submit'), "asd");
              }
              else
                $this->addElement('text', 'resdata_'.$attributes->name, $lang->getMsg('resdata_form_'.$attributes->name), array('size' => 30, 'maxlength' => 255));
            }
            
            if($attributes->type == "select") {
              $keys = new attributesSelectKeys;
              $keys->attribute_id = $attributes->id;
              $keys->find();
              
              $options = array();
              $options[0] = "----";
              while($keys->fetch())
                $options[$keys->key] = $lang->getMsg('resdata_form_select_'.$keys->value);
              sort($options); 

              $select_elements = array();
              for($i = 1; $attributes->amount >= $i; ++$i)
                $select_elements[] = &HTML_QuickForm::createElement('select', $i, null, $options);
              $this->addGroup($select_elements, 'resdata_'.$attributes->name, $lang->getMsg('resdata_form_'.$attributes->name), ' ');
            }

          }
        }
      }
      
      $this->addElement('select', 'type', $lang->getMsg('resdata_form_type'), array("2" => $lang->getMsg('resdata_form_type_borrow'), "1" => $lang->getMsg('resdata_form_type_give')));
      $free_pool = new poolsUser;
      $free_pool->user_id = $user->id;
      $free_pool->wait = 0;
      $free_pool->find();
      $free_pools = array();
      while($free_pool->fetch()) {
        $free_pool->fetchPool();
        $free_pools[] = &HTML_QuickForm::createElement('checkbox', $free_pool->pool->id, null, ' '.$free_pool->pool->name, $free_pool->pool->id);
      }
      $this->addGroup($free_pools, 'free_pools', $lang->getMsg('resdata_form_pools'), '<br>');
      $this->addElement('submit', 'submit', $lang->getMsg('resdata_form_submit'));
      
      // rules      
      
      if(!$_POST['resdata_isbn_submit']) {
        $this->addRule('name', $lang->getMsg('resdata_form_namenecessary'), 'required');
        $this->addRule('resdata_cat', $lang->getMsg('resdata_form_catnecessary'), 'required');
      }
      
      // presets      
      
      if($params->getParam('resdata_isbn_submit') && is_isbn($params->getParam('resdata_isbn'))) {
        $lastletter = 0;
        $isbnfound = 0;
        $firstletter = substr($params->getParam('resdata_isbn'),0,1);
        if($firstletter == 0 || $firstletter == 1)
          $urlendings = array('com', 'co.uk', 'de', 'jp', 'fr', 'ca');
        else if($firstletter == 2)
          $urlendings = array('fr', 'de', 'com', 'co.uk', 'jp', 'ca');
        else if($firstletter == 3)
          $urlendings = array('de', 'com', 'co.uk', 'jp', 'fr', 'ca');
        else if($firstletter == 4)
          $urlendings = array('jp', 'de', 'com', 'co.uk', 'fr', 'ca');
        else
          $urlendings = array('com', 'co.uk', 'de', 'fr', 'ca', 'jp');
          
        $lastletters = array(1,2,3,4,5,6,7,8,9,'x');
        foreach($urlendings as $urlending) {
          foreach($lastletters as $lastletter) {
          if($isbnfound == 0) {
            $url = "http://ecs.amazonaws.".$urlending."/onca/xml?Service=AWSECommerceService&AWSAccessKeyId=1WFW5KS6EFZ0M8690ZR2&Operation=ItemLookup&ItemId="
               .substr($params->getParam('resdata_isbn'),0,9).$lastletter
               ."&ResponseGroup=Medium&type=lite&f=xml";

            $xml = file_get_contents($url);
            if(!strpos($xml, 'is not a valid value for ItemId')) {
              $isbnfound = true;
            }
          }}
        }
        
        $first = strpos($xml, '<Item>')+6;
        $sec = strpos($xml, '</Item>');
        $newxml = substr($xml, $first, $sec-$first);
        $newxml = unhtmlentities($newxml);
        
        // title
        
        $first = strpos($newxml, '<Title>')+7;
        $sec = strpos($newxml, '</Title>');
        $title = substr($newxml, $first, $sec-$first);
        
        // binding

        $first = strpos($newxml, '<Binding>')+9;
        $sec = strpos($newxml, '</Binding>');
        $binding = substr($newxml, $first, $sec-$first);
        
        // publisher

        $first = strpos($newxml, '<Label>')+7;
        $sec = strpos($newxml, '</Label>');
        $publisher = substr($newxml, $first, $sec-$first);
        
        // publication date

        $first = strpos($newxml, '<PublicationDate>')+17;
        $sec = strpos($newxml, '</PublicationDate>');
        $publicationdate = substr($newxml, $first, $sec-$first);
        
        // number of pages

        $first = strpos($newxml, '<NumberOfPages>')+15;
        $sec = strpos($newxml, '</NumberOfPages>');
        $numberofpages = substr($newxml, $first, $sec-$first);
        
        // author(s)
        
        $authors = array();
        while(strstr($newxml, '<Author>')) {
          $first = strpos($newxml, '<Author>')+8;
          $sec = strpos($newxml, '</Author>');
          $authors[] = substr($newxml, $first, $sec-$first);
          $newxml = substr($newxml, $sec+9);
        }
        foreach($authors as $key => $author) {
          if($key != 0)
            $authors_field .= "; ";
          $authors_field .= $this->changeAuthor($author);
        }
        
        // description
        
        $first = strpos($newxml, '<EditorialReviews><EditorialReview><Source>Aus der Amazon.de-Redaktion</Source><Content>')+88;
        $sec = strpos($newxml, '</Content></EditorialReview></EditorialReviews>');
        $description = substr($newxml, $first, $sec-$first);
        $description = substr($description, 0, strrpos($description, '--'));

        // name
        if($authors_field)
          $name = $authors_field.": ".$title;
        else
          $name = $title;

        $this->setDefaults(array(
          'resdata_title' => $title,
          'name' => $name,
          'description' => $description,
          'resdata_authors' => $authors_field,
          'resdata_binding' => $binding,
          'resdata_number_of_pages' => $numberofpages,
          'resdata_publication_date' => $publicationdate,
          'resdata_publisher' => $publisher,
          'resdata_isbn' => $params->getParam('resdata_isbn')
        ));
      }
      
      if($params->getParam('res_id')) {
        $free_pool = new poolsResources;
        $free_pool->res_id = $params->getParam('res_id');
        $free_pool->find();
        $free_pools_presets = array();
        while($free_pool->fetch()) {
          $free_pools_presets[$free_pool->pool_id] = 1;
        }
      
        $changeform_res = new resources;
        $changeform_res->get($params->getParam('res_id'));
        $this->setDefaults(array(
          'name' => $changeform_res->name,
          'type' => $changeform_res->type,
          'description' => $changeform_res->description,
          'resdata_cat' => $changeform_res->cat,
          'free_pools' => $free_pools_presets,
          'public' => $changeform_res->is_public
        ));
        
        // presets for additional fields   
        
        if($params->getParam('cat')) {
          $cat = $params->getParam('cat');
          
          $this->setDefaults(array('resdata_cat' => $cat));
        
          $attributes = new attributes;
          $attributes->category_id = $cat;
          if($attributes->find()) {
            
            while($attributes->fetch()) {
          
              if($attributes->type == "string") {
                $attr_string_presets = new attributesString;
                $attr_string_presets->res_id = $params->getParam('res_id');
                $attr_string_presets->attribute_id = $attributes->id;
                $attr_string_presets->find(true);
          
                $this->setDefaults(array('resdata_'.$attributes->name => $attr_string_presets->value));
              }
            
              if($attributes->type == "select") {
                $attr_select_presets = new attributesSelect;
                $attr_select_presets->res_id = $params->getParam('res_id');
                $attr_select_presets->attribute_id = $attributes->id;
                $attr_select_presets->find();
                
                $i = 1;
                while($attr_select_presets->fetch()) {
                  $this->setDefaults(array("resdata_".$attributes->name."[".$i."]" => $attr_select_presets->value));
                  ++$i;
                }
              }
            
            }
          }
        }
      }
      
      else if(isset($pool)){
        $free_pools_presets[$pool->id] = 1;
          
        $this->setDefaults(array(
          'type' => 2,
          'public' => 0,
          'free_pools' => $free_pools_presets,
        ));
      }

      if($params->getParam('cat')) {
        $this->setDefaults(array(
          'resdata_cat' => $params->getParam('cat')));
      }  

    }
	
	// change authors name so that his surname comes first
   function changeAuthor($author) {
     $names = explode(" ", $author);

     // the last element is popped off and analysed
     // surname is extracted, the rest of it is push on the
     // array again and the surname is shifted at the beginning
     // e.a. is not a name
     if($names[count($names)-1] == "e.a." || $names[count($names)-1] == "ea.") {
       $last = $names[count($names)-2];
       $names[count($names)-2] = $names[count($names)-1];
     }
     else
       $last = $names[count($names)-1];
     $add = false;
     if(count(explode("(", $last)) > 1) {
       $expl = explode("(", $last);
       $last = $expl[0];
       $add = "(".$expl[1];
     }
         
     array_pop($names);
     if($names[0])
       array_unshift($names, $last.",");
     else
       array_unshift($names, $last);
     if($add)
       $names[count($names)-1] .= $add;
         
     return implode(" ", $names);
   }	
	
	function freezeForm() {
	  $this->removeElement('submit');
	  $this->freeze();
	}
    
}

?>