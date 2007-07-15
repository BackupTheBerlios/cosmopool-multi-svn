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
 * res browser
 */
 
require_once('./obj/pages/pageCommon.php');
require_once('./obj/forms/formResData.php');
 
class pageResData extends pageCommon{

    private $form;
    private $new_res_link;
    private $header;

    public function pageResData() {
      $this->pageCommon();
      
      $this->setTemplate('resdata.tpl');

      $this->process();

      // output
      $this->assignAll();
      $this->display();
    }
    
    private function process() {
      $this->commonProcess();
    
      $config = services::getService('config');
      $lang = services::getService('lang');
      $params = services::getService('pageParams');
      $categories = services::getService('cats');

      if($params->getParam('res_id'))
        $this->header = $lang->getMsg('resdata_header_change');
      else
        $this->header = $lang->getMsg('resdata_header_new');

	   $aItems = $categories->getThisAndBelow(1);
	   $sJavaScriptArray = sprintf('new Array(%s)', implode(',',array_keys($aItems)));
	   $this->sJavaScriptArray = $sJavaScriptArray;

      if($_POST['resdata_isbn_submit'] && is_isbn($_POST['resdata_isbn'])) {
        foreach($_POST as $key => $value)
          if($key != 'page' && $key != 'name' && $key != 'description' && $key != 'resdata_authors')
          $get .= $key.'='.$value.'&';
        $this->switchPage('resdata&'.$get);
      }

      // Instantiate the HTML_QuickForm object
      $this->form = new formResData('ResDataForm', $params->getParam($res_id), $this->user);

	   $this->new_res_link = false;
	   
      // Try to validate a form 

      if ($this->form->validate() && $this->form->exportValue('submit')) {
        $newres = new resources;

        if($params->getParam('res_id')) {
          $newres->get($params->getParam('res_id'));
        }

        $newres->name = $this->form->exportValue('name');
        $newres->description = $this->form->exportValue('description');
		
        $newres->cat = $this->form->exportValue('resdata_cat');
		  $newres->type = (in_array($newres->cat, array_keys($aItems)))
			? $this->form->exportValue('type')
			: 0;
        
        
        // insert/update in res-maintable
        
        if($params->getParam('res_id')) {
          $newres->update();
        }
        else {
          $newres->since = time();
          $newres->user_id = $this->user->id;
          $newres->insert();
        }

        $newres->find(true);

        // insert/update in attributes-tables
        
        $attr_string = new attributesString;
        $attr_string->res_id = $newres->id;
        $attr_string->delete();
        $attr_select = new attributesSelect;
        $attr_select->res_id = $newres->id;
        $attr_select->delete();
          
        if($params->getParam('cat')) {
          $cat = $params->getParam('cat');
        
          $attributes = new attributes;
          $attributes->category_id = $cat;
          if($attributes->find()) {
          
            while($attributes->fetch()) {
          
              if($attributes->type == "string") {
                $attr_string = new attributesString;
                          
                $attr_string->res_id = $newres->id;
                $attr_string->attribute_id = $attributes->id;
                
                // insert
                $value = $this->form->exportValue('resdata_'.$attributes->name);
                if($value != "") {
                  $attr_string->value = $value;
                  $attr_string->insert();
                }
              }
              if($attributes->type == "select") {
                $values = $this->form->getElementValue('resdata_'.$attributes->name);
                if(!is_array($values))
                $values = array($values);

                foreach($values as $value) if($value[0] != 0){
                  $attr_string = new attributesSelect;
                          
                  $attr_string->res_id = $newres->id;
                  $attr_string->attribute_id = $attributes->id;
                
                  // insert
                  $attr_string->value = $value[0];
                  $attr_string->insert();
                }
              }
            }
          }
        }

        // add res to pools if given
        $respools = new poolsResources;
        $respools->res_id = $newres->id;
        $respools->delete();

		  $res_pools = $this->form->exportValue('free_pools');
          if(is_array($res_pools))
		  foreach($res_pools as $pool_id => $bool) 
          if($bool) {
            $newres->addPool($pool_id);}

        if($params->getParam('res_id')) {
          $params->addParam('msg', 'msg_data_change_success', 'page');
          $this->switchPage('resmanager');
        }
        else {
          $this->form->removeElement('resdata_isbn_submit');
		    $this->form->freezeForm();
          $this->addMsg('msg_res_insert_success');
		    $this->new_res_link = true;
        }
      }
      if($this->form->exportValue('resdata_isbn_submit')) {
        $this->form->addRule('name', $lang->getMsg('resdata_form_namenecessary'), 'required');
        $this->form->addRule('description', $lang->getMsg('resdata_form_descnecessary'), 'required');
        $this->form->addRule('resdata_cat', $lang->getMsg('resdata_form_catnecessary'), 'required');
      }
    }
    
    private function assignAll() {
      $this->commonAssign();
      
      $tpl_engine = services::getService('tpl');
      $lang = services::getService('lang');
      $params = services::getService('pageParams');

      // Output the form
      $renderer = new renderer;

      $this->form->accept($renderer);
      $tpl_engine->assign('javascriptarray', $this->sJavaScriptArray);
      $tpl_engine->assign('form', $renderer->toHtml());
      $tpl_engine->assign('new_res_link', $this->new_res_link);
      $tpl_engine->assign('cat', $params->getParam('cat'));

      $tpl_engine->assign('header', $this->header);
    }
    
}
?>