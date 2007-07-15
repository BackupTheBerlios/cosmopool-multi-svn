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
require_once('./obj/ui/tables/tableResBrowser.php');
 
class pageResBrowser extends pageCommon{

    private $pool;
    private $cats = array();
    private $res;
    private $table;
    private $header;
    private $hierarchie;
	 private $get_add;
	 private $get_add_cat;
	 private $res_count = array();

    public function pageResBrowser() {
      $this->pageCommon();
      
      $this->setTemplate('resbrowser.tpl');

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
	  
      // process form	  
	   $this->processForm();
	   
      // if a pool is chosen, it is intanciated	   
	   
      if($params->getParam('pool_id')) {
        $pool = new pools;
        $pool->get($params->getParam('pool_id'));
        $get_add .= "&pool_id=$pool->id";
      }

      if(!$params->getParam('show_page')) {
        $params->addParam('show_page', 1, 'now');
      }

      // tabledata is fetched and ordered

      $tabledata = array();

      $res_fetcher = new resFetcher;
      $res_fetcher->_cat = $params->getParam('cat');

      if($params->getParam('action') == 'search') {
        $res_fetcher->_search_string = $params->getParam('searchstring');
        $res_fetcher->_pools = explode("a", $params->getParam('searchwhere'));
		  $get_add .= "&searchstring=".$params->getParam('searchstring');
		  $get_add .= "&searchwhere=".$params->getParam('searchwhere');
		  $get_add .= "&action=".$params->getParam('action');
      }
      else
        $res_fetcher->_pools = array($pool->id);
        
      if($params->getParam('order')) {
        $res_fetcher->_order = $params->getParam('order');}
      else $res_fetcher->_order = 'name';

      $res_fetcher->search();
      $showres = $res_fetcher->getAsArray();

      // contact and action-colums are build
      $count = 1;
      $page = $params->getParam('show_page');
      foreach($showres as $show_res) {
        if($count >= ($page * 20 - 19) && $count <= ($page * 20)) {
        $contact = "";
        $action = "";
        
        $show_res->fetchUser();
        
        // if the pool is browsed or a search is shown, the *_public-variables are proofed, if another pool
        // is browsed, all userdata ist shown. If only my pools are looked up by a search, all userdata is shown too.
        // data in the conta	ct-column

        // userdata is only shown, if he's in at least one of the pools
        // the logged-in user is a member of

        // show detalis if ressource id passed
        $detail = $show_res->id == $params->getParam('res_id');
		
        $email   = $show_res->user->email;
        $street  = $show_res->user->street;
        $house   = $show_res->user->house;
        $country = $show_res->user->country;
        $plz     = $show_res->user->plz;
        $city    = $show_res->user->city;
        $phone   = $show_res->user->phone;
        $user_desc = $show_res->user->description;
        
        if ($detail) {
          // attributes for detail-article are fetched        
        
          $attributes = new attributes;
          $category_id = $show_res->cat;
          
          $attributes->find();

          $res_attr_array = array();
          
          while($attributes->fetch()) {
          
            // string-attributes
            if($attributes->type == "string") {
              $res_attr = new attributesString;
              $res_attr->res_id = $show_res->id;
              $res_attr->attribute_id = $attributes->id;
              if($res_attr->find(true))
                $res_attr_array[] = array("value" => $res_attr->value,
                                          "name" => $attributes->name);
            }
            // select-attributes
            if($attributes->type == "select") {
              $res_attr = new attributesSelect;
              $res_attr->res_id = $show_res->id;
              $res_attr->attribute_id = $attributes->id;
              if($res_attr->find()) {
                while($res_attr->fetch()) {
                  $keys = new attributesSelectKeys;
                  $keys->key = $res_attr->value;
                  $keys->find(true);
                  $value = $value.$lang->getMsg('resdata_form_select_'.$keys->value).'&nbsp;';
                }
                $res_attr_array[] = array("value" => $value,
                                          "name" => $attributes->name);
              }
            }
          }
        
          if($this->user->inMine($show_res->user->id))
            if($show_res->user->id == $this->user->id)
              $prove_public = 2;
			   else
		        $prove_public = false;
	       else
		      $prove_public = true;
		  }
		  else
		    $prove_public = false;
		  
        $is_waiting = new resWait;
        $is_waiting->user_id = $this->user->id;
        $is_waiting->res_id = $show_res->id;
        
        if(strlen($show_res->name) > 60)
          $show_res->name = substr($show_res->name, 0, 60).'...';

		  $act_row = array(
		  'res_id'         => $show_res->id,
		  'name'           => $show_res->name,
		  'description'    => $show_res->description,
		  'type'           => $show_res->type,
		  'user_id'        => $show_res->user->id,
		  'user_name'      => $show_res->user->name,
		  'own_ressource'  => $show_res->user->id == $this->user->id,
		  'available'      => $show_res->isAvailable(),
		  'is_waiting'     => $is_waiting->find(),
		  'prove_public'   => $prove_public,
		  'detail'         => $detail,
		  'user_email'     => $email,
		  'user_street'    => $street,
		  'user_house'     => $house,
		  'user_country'   => $country,
		  'user_plz'       => $plz,
		  'user_city'      => $city,
		  'user_phone'     => $phone,
		  'user_user_desc' => $user_desc
		  );
		  if($detail)
		    $act_row = array_merge($act_row, array('attributes' => $res_attr_array));
		  $tabledata[] = $act_row;
		  
		  }++$count;
      }--$count;
      
      $count2 = 1;
      while($count2 < ($count / 20)) {
        $this->res_count[] = $count2;
        ++$count2;
      }
      
      $this->get_add_cat = $get_add;
      $get_add .= "&cat=".$params->getParam('cat');
      
      // categories to refine search

      $showcats = $categories->getChildren($params->getParam('cat'));
	  
      if(is_array($showcats)) {
        foreach($showcats as $cat_id => $cat_name) {
          $show_res = new resFetcher;
          $show_res->_cat = $cat_id;
		    if($params->getParam('action') == 'search') {
            $show_res->_search_string = $params->getParam('searchstring');
            $show_res->_pools = explode("a", $params->getParam('searchwhere'));
          }
          else
            $show_res->_pools = array($pool->id);
    
          $rescounter = $show_res->count();

          if($rescounter > 0)
            $this->cats[$cat_id] = array("name" => $cat_name, "count" => $rescounter);
        }
      }
      
	   $this->get_add = $get_add;
	   
	   // table itself
	  
      $table = new tableResBrowser($tabledata, $get_add);

      // page-header

      if($params->getParam('action') == 'search') 
        $this->header = $lang->getMsg('resbrowser_header_search');
      else
        $this->header = $lang->getMsg('resbrowser_header_browse').$pool->name;
        
      // hierarchie-links

      $parent = $categories->getParent($params->getParam('cat'));
      if($parent) {
        $hierarchie = array();
        $hierarchie[] = array('id' => $parent, 'name' => $categories->getName($parent));
  
        $parent = $categories->getParent($parent);
        if($parent) {
          $hierarchie[] = array('id' => $parent, 'name' => $categories->getName($parent));
        }
        $this->hierarchie = array_reverse($hierarchie);
      }
      
      $this->table = $table;
      $this->pool = $pool;
    }
    
	private function processForm() {
	
	  $mail = services::getService('mail');
	  $params = services::getService('pageParams');
            
      // form procession
      $res = new resources;
      if($params->getParam('submit')) {
        $res->get($params->getParam('id'));

        // no item
        if($res->type == 0) {
          $res->addBorrow($this->user->id, $params->getParam('comments'));
          $this->addMsg('msg_added_request');
          
          $owner = new user;
          $owner->get($res->user_id);
          $mail->send('nogood_order', $owner->email, $res);
        }
    
        // beeing given
        if($res->type == 1) {
          $res->addGiven($this->user->id, $params->getParam('comments'));
          $this->addMsg('msg_added_given');
          
          $owner = new user;
          $owner->get($res->user_id);
          $mail->send('give_order', $owner->email, $res);
        }
    
        // borrow
        if($res->type == 2) {
          $res->addBorrow($this->user->id, $params->getParam('comments'));
          $this->addMsg('msg_added_borrow');
          
          $owner = new user;
          $owner->get($res->user_id);
          $mail->send('borrow_order', $owner->email, $res);        }
      }
	 }
	
    private function assignAll() {
      $this->commonAssign();
      
      $tpl_engine = services::getService('tpl');
      $lang = services::getService('lang');
      $cats = services::getService('cats');
      $params = services::getService('pageParams');

      $tpl_engine->assign('header', $this->header);
      
      $tpl_engine->assign('restable', $this->table->toHtml());
        
      $tpl_engine->assign('pool', $this->pool);
      $tpl_engine->assign('res_count', $this->res_count);
      $tpl_engine->assign('get_add', $this->get_add);
      $tpl_engine->assign('get_add_cat', $this->get_add_cat);
      $tpl_engine->assign('cats', $this->cats);
      $tpl_engine->assign('hierarchie', $this->hierarchie);
      $tpl_engine->assign('act_cat', $cats->getName($params->getParam('cat')));
      $tpl_engine->assign('act_cat_id', $params->getParam('cat'));
      $tpl_engine->assign('act_page', $params->getParam('show_page'));
      
    }
    
}
?>