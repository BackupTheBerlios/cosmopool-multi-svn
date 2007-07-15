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

class resFetcher extends resources
{
    var $res;
    var $_cat; 						// int
    var $_give_want;						// int
    var $_pools;					// array of int
    var $_search_string;			// string
    var $_search_description;	// bool
    var $_order; 					// string
    var $_user;

    // constructor
    function __construct() {
      $this->_search_description_to = false;
      $this->_non_public_to = false;
    }

    // search
    function search() {
      $conditions = array();
      $tables = $this->__table;
      
      if($this->_user) {
        $conditions[] = "(pools_resources.user_id = ".$this->_user.")";
      }
      
      if($this->_cat != "") {
        $categories = services::getService('cats');
      
        $catcons = array();

        $count = 1;

        $searchcats = $categories->getThisAndBelow($this->_cat);

        foreach($searchcats as $id => $name) {
          if($count != 1)
            $catcon .= " OR ";
          $catcon .= "(pools_resources.cat = $id)";
          ++$count;
        }

        $conditions[] = '('.$catcon.')';
      }

      if(isset($this->_give_want))
        $conditions[] = "($this->__table.give_want = $this->_give_want)";
      
      if(is_array($this->_pools)) {
        $tables .= ", pools_pools_resources";
        $pool_con = "(($this->__table.id = pools_pools_resources.res_id) AND (";
        foreach($this->_pools as $pool_id) {
          if($pool_id) {
            if($pool_con == "(($this->__table.id = pools_pools_resources.res_id) AND (")
              $pool_con .= "(pools_pools_resources.pool_id = ".$pool_id.") ";
            else
              $pool_con .= " OR (pools_pools_resources.pool_id = ".$pool_id.")";
          }
        }
        $conditions[] = $pool_con.'))';
      }
      
      if(!isset($this->_search_string)) 
        $this->_search_string = "";
      $searchstrings = explode(" ", $this->_search_string);
      foreach($searchstrings as $search) {
        if($search) {
          if(!isset($search_con))
            $search_con = "((".$this->__table.".".name." LIKE '%".$search."%') OR (".$this->__table.".".description." LIKE '%".$search."%'))";
          else
            $search_con .= " AND ((".$this->__table.".".name." LIKE '%".$search."%') OR (".$this->__table.".".description." LIKE '%".$search."%'))";
        }
      }
      $conditions[] = $search_con;

      foreach($conditions as $con) {
        if($con) {
          if(!isset($where)) 
            $where .= $con;
          else
            $where .= " AND ".$con;
        }
      }
      if(isset($where))
        $where = "WHERE ".$where;
      if(isset($this->_order))
        $where = $where." ORDER BY $this->_order";

      $this->res = new resources;
      $this->res->query("SELECT DISTINCT pools_resources.* FROM $tables $where");
    }
    
    function count() {
      $this->search();

      $count = 0;
      while($this->res->fetch()) {
        ++$count;
      }
      return $count;
    }
    
    function getAsArray() {
      $array = array();
    
      while($this->res->fetch()) {
        $array[] = clone $this->res;
      }
      return $array;
    }
    
}
?>