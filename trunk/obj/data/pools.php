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
 * Table Definition for pools_pools
 */
require_once 'DB/DataObject.php';

class pools extends DB_DataObject 
{

	 var $res;
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    var $__table = 'pools_pools';                     // table name
    var $id;                              // int(4)  not_null primary_key auto_increment
    var $name;                            // string(50)  
    var $description;                     // blob(16777215)  blob
    var $country;                         // string(5)  
    var $area;                            // string(50)  
    var $city;                            // string(50)  
    var $plz;                            // string(50)  
    var $wait;                            // int(1)  
    var $is_public;                            // int(1)  
    var $is_located;                            // int(1)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('data_obj_Pools_pools',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
    
    function getDescription() {
      $text = $this->description;
      $text = convertNewsSubmits($text);
      return wordwrap($text,55,' ',true);
    }    
    
    function removeMember($user_id) {
      $member_to_remove = new poolsUser;
      $admin_to_remove = new poolsAdmin;
      $member_to_remove->pool_id = $this->id;
      $admin_to_remove->pool_id = $this->id;
      $member_to_remove->user_id = $user_id;
      $admin_to_remove->user_id = $user_id;
      
      $member_to_remove->delete();
      $admin_to_remove->delete();
	   $userres = new resFetcher;
	   $userres->_pools = array($this->id => $this->id);
	   $userres->_user = $user_id;
	   $userres->search();
	   while($userres->res->fetch()) {
	     $res_pool = new poolsResources;
	     $res_pool->pool_id = $this->id;
	     $res_pool->res_id = $userres->res->id;
	     $res_pool->delete();
	   }
    }

    function removeAllMembers() {
      $member_to_remove = new poolsUser;
      $admin_to_remove = new poolsAdmin;
      $member_to_remove->pool_id = $this->id;
      $admin_to_remove->pool_id = $this->id;
      
      $admin_to_remove->delete();
      return $member_to_remove->delete();
    }

    function removeAllRes() {
      $remove_res = new poolsResources;
      $remove_res->pool_id = $this->id;
      $remove_res->delete();
    }
    
    function deleteAll() {
      $usercount = $this->removeAllMembers();
      $this->removeAllRes();
      if(!$this->delete())
        return FALSE;
      else return $usercount;
    }
    
    function getAdminEMails() {
      $pool_admins = new poolsAdmin;
      $pool_admins->pool_id = $this->id;
      
      $emails = array();
      $pool_admins->find();
      while($pool_admins->fetch()) {
        $pool_admins->fetchUser();
        $emails[] = $pool_admins->user->email;
      }
      return $emails;
    }
    
    function getAdmins() {
      $pool_admins = new poolsAdmin;
      $pool_admins->pool_id = $this->id;
      
      $admins = array();
      $pool_admins->find();
      
      while($pool_admins->fetch()) {
        $pool_admins->fetchUser();
        $admins[] = clone $pool_admins->user;
      }
      return $admins;
    }
    
    function isMember($user_id, $wait_also = false) {
      if($user_id) {
        $check_member = new poolsUser;
        $check_member->user_id = $user_id;
        $check_member->pool_id = $this->id;
        if(!$wait_also) {
          $check_member->wait = '0';}
        if($check_member->find())
          return true;
      }
      else if($this->name == "Pool")
        return true;
      else return false;
    }
	
	function isWaiting($user_id) {
      if($user_id) {
        $check_admin = new poolsUser;
		$check_admin->wait = 1;
        $check_admin->user_id = $user_id;
        $check_admin->pool_id = $this->id;
        return $check_admin->find();
      }
      else return false;
    }
    
    function isAdmin($user_id) {
      if($user_id) {
        $check_admin = new poolsAdmin;
        $check_admin->user_id = $user_id;
        $check_admin->pool_id = $this->id;
        return $check_admin->find();
      }
      else return false;
    }

    function isLastAdmin($user_id) {
        $check_admin = new poolsAdmin;
        $check_admin->user_id = $user_id;
        $check_admin->pool_id = $this->id;
        $isadmin = $check_admin->find();
        
        if($isadmin) {
          $check_one_admin = new poolsAdmin;
          $check_one_admin->pool_id = $this->id;
          
          $check_one_admin->find();
          
          while($check_one_admin->fetch()) {
            if($check_one_admin->user_id != $user_id) {
              return false;}
          }
              return true;
        }
        else return false;
    }

    function isRes($res_id) {
      if($res_id) {
        $check_res = new poolsResources;
        $check_res->res_id = $res_id;
        $check_res->pool_id = $this->id;
        return $check_res->find();
      }
      else return false;
    }
    
    function addMember($user_id) {
      $add_member = new poolsUser;
      $add_member->user_id = $user_id;
      $add_member->pool_id = $this->id;
      $add_member->wait = 0;
      $add_member->insert();
    }

    function addAdmin($user_id) {
      if(!$this->isMember($user_id))
        $this->addMember($user_id);
      $add_admin = new poolsAdmin;
      $add_admin->user_id = $user_id;
      $add_admin->pool_id = $this->id;
      $add_admin->insert();
    }

    function addRes($res_id) {
      $add_res = new poolsResources;
      $add_res->res_id = $res_id;
      $add_res->pool_id = $this->id;
      $add_res->insert();
    }
}
?>