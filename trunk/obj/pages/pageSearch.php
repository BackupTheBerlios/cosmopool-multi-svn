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
require_once('./obj/forms/formSearch.php');
require_once('./obj/forms/rendererSearch.php');
 
class pageSearch extends pageCommon{

    private $form;
    private $pools = array();
    private $pools_get;

    public function pageSearch() {
      $this->pageCommon();
      
      $this->setTemplate('search.tpl');

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

      // Instantiate the HTML_QuickForm object
      $this->form = new formSearch('SearchForm');

      // fetch users pools
      $my_pools_ids = $this->user->getPoolIDs();
      foreach($my_pools_ids as $pool_id) {
        $userpool = new pools;
        $userpool->id = $pool_id;
        $userpool->find(true);
        $this->pools_get .= $pool_id.'a';
        $this->pools[] = array($pool_id, $userpool->name);
      }
      
      $this->form->setPools($this->pools, $this->pools_get);

      // Try to validate a form 
      if ($this->form->validate()) {
  
        $search_res = new resFetcher;
        $search_res->_cat = $this->form->exportValue('cat');
        $search_res->_search_string = $this->form->exportValue('searchstring');
        $search_res->_pools = $this->form->exportValue('searchwhere');
        $pool_ids = array();
        $pools_get = $this->form->exportValue('searchwhere');

        /*$something_found = true;
        if($params->getParam('cat')) {
          $cat = $params->getParam('cat');
        
          $attributes = new attributes;
          $attributes->category_id = $cat;

          if($attributes->find()) {
          
            while($attributes->fetch()) {
          
              if($attributes->type == "string") {
                $attr_string = new attributesString;
                          
                $attr_string->attribute_id = $attributes->id;
                
                // insert
                $attr_string->query("SELECT DISTINCT pools_attributes_string WHERE value LIKE '%".$this->form->exportValue('search_'.$attributes->name)."%');
                $value = $this->form->exportValue('search_'.$attributes->name);
                if($value != "") {
                  $attr_string->value = $value;
                  if(!$attr_string->find())
                    $something_found = false;(".$this->__table.".".name." LIKE '%".$search."%')
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
        }*/

        if($search_res->count() < 1)
          $this->addMsg('msg_no_results');
        else {
          $this->switchPage('resbrowser&cat='.$this->form->exportValue('cat').
                            '&searchwhere='.$pools_get.
                            '&searchstring='.$this->form->exportValue('searchstring'));
        }
      }
    }
    
    private function assignAll() {
      $this->commonAssign();
      
      $tpl_engine = services::getService('tpl');
      $lang = services::getService('lang');

      // Output the form
      $renderer = new rendererSearch;

      $this->form->accept($renderer);
      $tpl_engine->assign('form', $renderer->toHtml());

      $tpl_engine->assign('header', $lang->getMsg('search_header'));
    }
    
}
?>