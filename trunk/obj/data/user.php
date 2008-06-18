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
 * Table Definition for pools_user
 */
require_once 'DB/DataObject.php';

class user extends DB_DataObject 
{

    var $login = FALSE;
    var $photo = FALSE;
    var $preferences;

    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    var $__table = 'pools_user';                      // table name
    var $id;                              // int(6)  not_null primary_key auto_increment
    var $name;                            // string(50)  
    var $plz;                             // string(5)  
    var $city;                            // string(30)  
    var $street;                          // string(50)  
    var $house;                           // string(10)  
    var $plz_city_public;                 // int(1)  
    var $country;                 // int(1)  
    var $email;                           // string(50)  
    var $email_public;                           // string(50)  
    var $password;                        // string(40)  
    var $phone;                           // string(20)  
    var $phone_public;                    // int(1)  
    var $description;                     // blob(16777215)  blob
    var $main_photo;
    var $language;                           // string(10)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('data_obj_Pools_user',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE

    // constructor
    function user($login = "", $password = "") {
      if(($login != "") && ($password != "")){
        $this->name = $login;
        $this->password = $password;
        $this->login = true;
      }
    }
    
    function fetchPreferences() {
      $this->preferences = new userPreferences;
      $this->preferences->user_id = $this->id;
      if($this->preferences->find())
        $this->preferences->fetch();
      else {
        $this->preferences->welcome_message = 1;
        $this->preferences->insert();
        
      }
    }
    
    function isAdmin($pool_id = "") {
      $is_admin = new poolsAdmin;
      if($pool_id != "")
        $is_admin->pool_id = $pool_id;
      $is_admin->user_id = $this->id;
      return $is_admin->find();
    }

    function inMine($user_id) {
      $pools = new poolsUser;
	   $pools->wait = 0;
	   $pools->user_id = $user_id;
	   $pools->find();
	   while($pools->fetch()){
	     $pools->fetchPool();
	     if(!$pools->pool->is_public) {
		  if ($this->isMember($pools->pool_id))
		    return true;
		  }
	   }
      return false;
    }
	
    function isMember($pool_id) {
      $is_member = new poolsUser;
      $is_member->pool_id = $pool_id;
      $is_member->user_id = $this->id;
      return $is_member->find();
    }

    function removePool($pool_id) {
      $remove_member = new poolsUser;
      $remove_member->pool_id = $pool_id;
      $remove_member->user_id = $this->id;
      
      $remove_member->delete();
    }
   
    function getWaitingRes() {
      $wait_res = new resources;
      $wait_res->user_id = $this->id;

      $res = array();
      if($wait_res->find()) {
        while($wait_res->fetch()) {
          $wait_res->fetchWaitEntrys();
          if(is_array($wait_res->wait)) {
            $res[] = clone $wait_res;
          }
        }
        return $res;
      }
    }

    function getBorrowedRes() {
      $bow_res = new resources;
      $bow_res->user_id = $this->id;

      $res = array();
      if($bow_res->find()) {
        while($bow_res->fetch()) {
          $bow_res->fetchBorrower();
          if($bow_res->borrowed)
            $res[] = clone $bow_res;
        }
        return $res;
      }
    }
    
    function getPoolIDs($wait_also = FALSE) {
      $pool_ids = new poolsUser;
      
      $pool_ids->user_id = $this->id;
      
      $ids = array();
      if($pool_ids->find()) {
        while($pool_ids->fetch()) {
          if(($wait_also == FALSE && $pool_ids->wait != 1) || $wait_also == TRUE)
            $ids[] = $pool_ids->pool_id;
        }
        return $ids;
      }
      else
        return false;
    }
    
    function addMembership($pool_id) {
      $mail = services::getService('mail');

      // add to relations-table
      $new_membership = new poolsUser;
      $new_membership->user_id = $this->id;
      $new_membership->pool_id = $pool_id;
      if($pool_id != 1)
        $new_membership->wait = 1;
      else
        $new_membership->wait = 0;
      $new_membership->insert();
      
      // compose E-Mails, if it wasn't the pool to be added
      $new_apply_pool = new pools;
      $new_apply_pool->get($pool_id);
      $tos = $new_apply_pool->getAdmins();
      foreach($tos as $to)
        $mail->send('new_member', $to, $new_apply_pool);
    }
    
    function getPhoto() {
      $photo = new userPhotos;
      $photo->id = $this->main_photo;
      if($this->main_photo) {
      if($photo->find(true)) {
        $this->photo = $photo;
        return true;
      }
      else
        return false;
      }
    }
    
    function getCountry() {
      $countries = services::getService('countries');
      if($this->country) {
        return $countries->getCountry($this->country);
      }
    }
    
    function hasResources() {
      $resources = new resources;
      $resources->user_id = $this->id;
      if($resources->find())
        return true;
      else
        return false;
    }
}
?>