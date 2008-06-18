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
 * Table Definition for pools_resources
 */
require_once 'DB/DataObject.php';

class resources extends DB_DataObject 
{

    var $user;
    var $wait = array();
    var $borrowed;
    var $borrower;
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    var $__table = 'pools_resources';                 // table name
    var $id;                              // int(8)  not_null primary_key auto_increment
    var $user_id;                         // int(6)  
    var $name;                            // string(100)  
    var $description;                     // blob(16777215)  blob
    var $when_available;                  // blob(16777215)  blob
    var $since;                           // int(14)  not_null unsigned zerofill timestamp
    var $type;                       // int(1)  
    var $cat;                             // int(2)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('data_obj_Pools_resources',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE

    function getDescription() {
      $text = $this->description;
      $text = convertNewsSubmits($text);
      return $text;
    }    

    function getSince() {
      return $this->since;
    }

    function fetchName() {
      $this->fetchBorrower();
      
      if(! $this->isAvailable()) 
        $this->name = $this->name.' </b><font color="red">(verliehen an <b>'.$this->borrower->name.'</b>)<b></b></font>';
    }
    
    function deletePools() {
      $pool_aff = new poolsResources;
      $pool_aff->res_id = $this->id;
      $pool_aff->delete();
    }

    function deleteWaiting($id = false) {
      $waiting = new resWait;
	  if ($id) $waiting->user_id = $id;
      $waiting->res_id = $this->id;
      $waiting->delete();
    }

    function deleteAll() {
      $aff1 =  new resWait;
      $aff2 =  new resBorrowed;
      $aff3 =  new poolsResources;
      $aff4 =  new attributesString;
      $aff5 =  new attributesSelect;
    
      $aff1->res_id = $this->id;
      $aff1->delete();
      $aff2->res_id = $this->id;
      $aff2->delete();
      $aff3->res_id = $this->id;
      $aff3->delete();
      $aff4->res_id = $this->id;
      $aff4->delete();
      $aff5->res_id = $this->id;
      $aff5->delete();

      $this->deletePools();
      return $this->delete();
    }

    function getTypeFormat() {
      switch ($this->type) {
        case 1:
          return 'Verschenke';
        case 2:
          return 'Verborge';
        case 3:
          return 'Verschenke';
        case 4:
          return 'Verschenke';
        case 5:
          return 'Verschenke';
        case 6:
          return 'Verschenke';
        case 7:
          return 'Verschenke';
      }
    }
    
    function fetchUser() {
      $this->user = new user;
      $this->user->get($this->user_id);
    }
    
    function fetchBorrower() {
      $this->borrowed = false;
      $borrowers = new resBorrowed;
      $borrowers->res_id = $this->id;
      
      if($borrowers->find(true)) {
        $this->borrower = new user;
        $this->borrower->get($borrowers->user_id);
        $this->borrowed = true;
      }
    }
    
    function fetchWaitEntrys() {
      $this->wait = "";
      $wait = new resWait;
      $wait->res_id = $this->id;
      
      if($wait->find()) {
        $this->wait = array();
        while($wait->fetch()) {
          $wait->fetchUser();
          $this->wait[] = clone $wait;
        }
      }
    }
    
    function addWaitEntry($user_id, $comments) {
      $new_given = new resWait;
      $new_given->res_id = $this->id;
      $new_given->user_id = $user_id;
	  if(!$new_given->find())
	    $insert = true;
      else
	    $insert = false;
	  $new_given->comments = $comments;
      if($insert == true)
        $new_given->insert();
    }
    
    function addGiven($user_id, $comments) {
      $this->addWaitEntry($user_id, $comments);
    }

    function addBorrow($user_id, $comments) {
      $this->addWaitEntry($user_id, $comments);
    }
    
    function changeOwner($user_id) {
      $this->user_id = $user_id;
      $this->update();
    }
    
    function isBorrowed($user_id) {
      $new_borrower = new resBorrowed;
      $new_borrower->res_id = $this->id;
      $new_borrower->user_id = $user_id;
      $new_borrower->insert();
      $this->borrowed = true;
    }
    
    function isAvailable() {
      $new_borrower = new resBorrowed;
      $new_borrower->res_id = $this->id;
      if($new_borrower->find())
        return false;
      return true;
    }

    function isPool($pool_id) {
      $is_pool = new poolsResources;
      $is_pool->pool_id = $pool_id;
      $is_pool->res_id = $this->id;
      if($is_pool->find())
        return true;
      else
        return false;
    }
    
    function inMine($user_id) {
      $in_mine = new resources;
      $in_mine->query('SELECT DISTINCT name FROM pools_resources, pools_pools_resources, pools_pools_user WHERE 
                       (pools_resources.id = '.$this->id.') AND 
                       (pools_pools_user.user_id = '.$user_id.') AND
                       (pools_pools_resources.res_id = pools_resources.id) AND 
                       (pools_pools_user.pool_id = pools_pools_resources.pool_id)');
      while($in_mine->fetch()) {
        return true;
      }
      return false;
    }

    function getSinceFormat() {
      return date('j. n. Y', $this->getSince());
    }
    
    function getCatFormat() {
      $categories = services::getService('cats');
      
      return $categories->getName($this->cat);
    }

    function addPool($pool_id) {
      // add to relations-table
      $new_membership = new poolsResources;
      $new_membership->res_id = $this->id;
      $new_membership->pool_id = $pool_id;
      if(!$new_membership->insert())
        $new_membership->update();
    }
}
?>