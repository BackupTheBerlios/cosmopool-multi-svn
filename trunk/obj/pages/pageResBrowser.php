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
	 private $pools_get;
	 private $pools = array();
	 private $attributes = array();
	 private $attribute_presets = array();

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
      
      $is_one_pool = false;
      if(!(count(explode("a", $params->getParam('searchwhere')))>1)) {
        $pool = new pools;
        $pool->id = $params->getParam('searchwhere');
        $pool->find(true);
        $is_one_pool = true;
      }

      if(!$params->getParam('show_page')) {
        $params->addParam('show_page', 1, 'now');
      }

      // get Attributes      
      
      $attr = new attributes;
      $attr->category_id = $params->getParam('cat');

      if($attr->find()) {
        while($attr->fetch()) {
          $this->attributes[] = clone $attr;
        }
	   }
      
      // tabledata is fetched and ordered

      $tabledata = array();

      $res_fetcher = new resFetcher;
      $res_fetcher->_cat = $params->getParam('cat');

      $res_fetcher->_search_string = $params->getParam('searchstring');
      $get_add .= "&searchstring=".$params->getParam('searchstring');
	   $get_add .= "&searchwhere=".$params->getParam('searchwhere');

      if($is_one_pool)
        $res_fetcher->_pools = array($pool->id);
      else
        $res_fetcher->_pools = explode("a", $params->getParam('searchwhere'));

      // fetch users pools
      $my_pools_ids = $this->user->getPoolIDs();
      foreach($my_pools_ids as $pool_id) {
        $userpool = new pools;
        $userpool->id = $pool_id;
        $userpool->find(true);
        $this->pools_get .= $pool_id.'a';
        $this->pools[] = array($pool_id, $userpool->name);
      }
        
      if($params->getParam('order')) {
        $res_fetcher->_order = $params->getParam('order');}
      else $res_fetcher->_order = 'name';

      $res_fetcher->search();
      $showres = $res_fetcher->getAsArray();

      // presets for attributes
      
      foreach($this->attributes as $attr_obj) {
        if($params->getParam('attribute'.$attr_obj->id)) {
          $this->attribute_presets[$attr_obj->id] = $params->getParam('attribute'.$attr_obj->id);
          $get_add .= "&attribute".$attr_obj->id."=".$params->getParam('attribute'.$attr_obj->id);
        }
      }
        
      // contact and action-colums are build
      
      $count = 1;
      $page = $params->getParam('show_page');
      foreach($showres as $show_res) {
        $fitsattr = true;
        
        foreach($this->attributes as $attr_obj) {
          // string-type
          
          if($params->getParam('attribute'.$attr_obj->id)) {
            if($attr_obj->type == "string") {
              $resattr = new attributesString;
              $resattr->attribute_id = $attr_obj->id;
              $resattr->res_id = $show_res->id;
              if(!$resattr->isLike($params->getParam('attribute'.$attr_obj->id)))
                $fitsattr = false;
            }
            if($attr_obj->type == "select") {
              $resattr = new attributesSelect;
              $resattr->attribute_id = $attr_obj->id;
              $resattr->res_id = $show_res->id;
              if($resattr->find()) {
                $fitsattr = false;
                while($resattr->fetch()) {
                  $select_keys = new attributesSelectKeys;
                  $select_keys->key = $resattr->value;
                  $select_keys->find(true);
                  if(stripos ( $lang->getMsg('resdata_form_select_'.$select_keys->value), $params->getParam('attribute'.$attr_obj->id)) !== false)
                    $fitsattr = true;
                }
              }
              else
                $fitsattr = false;
            }
          }
        }
        
        if($fitsattr) {

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
      }}--$count;
      
      $count2 = 1;
      while($count2 < ($count / 20)) {
        $this->res_count[] = $count2;
        ++$count2;
      }
        $this->res_count[] = $count2;
      
      $this->get_add_cat = $get_add;
      $get_add .= "&cat=".$params->getParam('cat');
      
      // categories to refine search

      $showcats = $categories->getChildren($params->getParam('cat'));
	  
      if(is_array($showcats)) {
        foreach($showcats as $cat_id => $cat_name) {
          $show_res = new resFetcher;
          $show_res->_cat = $cat_id;
		    $show_res->_search_string = $params->getParam('searchstring');
		    if(!$is_one_pool)
            $show_res->_pools = explode("a", $params->getParam('searchwhere'));
          else
            $show_res->_pools = array($pool->id);
    
          $rescounter = $show_res->count();

          if($rescounter > 0)
            $this->cats[] = array("id" => $cat_id, "name" => $cat_name, "count" => $rescounter);
          
        }
          // order categories after rescount
          $c = 0;
          foreach($this->cats as $cat) {
            if($c == 0) {
              $ocats = array($cat);}
            else {
            $c2=0;
            while($c2 <= $c) {
              if($cat["count"] <= $ocats[$c2]["count"]) {
                $before = array_slice($ocats, 0, $c2);
                $after = array_slice($ocats, $c2);
                if(is_array($before[0])) {
                  $ocats = array_merge($before, array($cat));
                  if(is_array($after[0])) 
                    $ocats = array_merge($ocats, $after);
                }
                else
                  $ocats = array_merge(array($cat), $after);
                $c2=$c+1;
              }
              else if(($cat["count"] > $ocats[$c2]["count"]) && (($cat["count"] <= $ocats[$c2+1]["count"]) || !$ocats[$c2+1]["count"])) {
                $before = array_slice($ocats, 0, $c2+1);
                $after = array_slice($ocats, $c2+1);
                if(is_array($after[0])) {
                  $ocats = array_merge(array($cat), $after);
                  if(is_array($before[0])) 
                    $ocats = array_merge($before, $ocats);
                }
                else
                  $ocats = array_merge($before, array($cat));
                $c2=$c+1;
              }
              ++$c2;
            }
            }
            ++$c;
          }
          if(is_array($ocats))
            $this->cats = array_reverse($ocats);
          
          // add subcategories to the most counting category
          $lowercats = $categories->getChildren($this->cats[0]["id"]);
          if(is_array($lowercats)) {
            foreach($lowercats as $cat_id => $cat_name) {
              $show_res = new resFetcher;
              $show_res->_cat = $cat_id;
	    	     $show_res->_search_string = $params->getParam('searchstring');
	     	     if(!$is_one_pool)
                $show_res->_pools = explode("a", $params->getParam('searchwhere'));
              else
                $show_res->_pools = array($pool->id);
    
              $rescounter = $show_res->count();

              if($rescounter > 0)
                $this->lowercats[] = array("id" => $cat_id, "name" => $cat_name, "count" => $rescounter);
          
            }
          }
      }
	   $this->get_add = $get_add;
	   
	   // table itself
	  
      $table = new tableResBrowser($tabledata, $get_add);

      // page-header

      $this->header = $lang->getMsg('resbrowser_header_search');
        
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
      else if($params->getParam('cat') != 0) {
        $this->hierarchie = array(array('id' => 0, 'name' => $lang->getMsg('cat_all')));
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
        
      if($params->getParam('searchstring'))
        $tpl_engine->assign('searchstring', $params->getParam('searchstring'));
      if($params->getParam('searchwhere'))
        $tpl_engine->assign('searchwhere', $params->getParam('searchwhere'));

      $tpl_engine->assign('pool', $this->pool);
      $tpl_engine->assign('res_count', $this->res_count);
      $tpl_engine->assign('get_add', $this->get_add);
      $tpl_engine->assign('get_add_cat', $this->get_add_cat);
      $tpl_engine->assign('cats', $this->cats);
      $tpl_engine->assign('lowercats', $this->lowercats);
      $tpl_engine->assign('hierarchie', $this->hierarchie);
      $tpl_engine->assign('act_cat', $cats->getName($params->getParam('cat')));
      $tpl_engine->assign('act_cat_id', $params->getParam('cat'));
      $tpl_engine->assign('act_page', $params->getParam('show_page'));
      $tpl_engine->assign('pools_get', $this->pools_get);
      $tpl_engine->assign('pools', $this->pools);
      $tpl_engine->assign('attributes', $this->attributes);
      $tpl_engine->assign('attribute_presets', $this->attribute_presets);
      
    }
    
}
?>