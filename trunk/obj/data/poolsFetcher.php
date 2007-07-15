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

class poolsFetcher extends pools
{

    var $_user;                            // all pools or just one user
    var $_admin;
    var $_order;
    var $_wait;
    var $_is_located;
    var $_is_public;
    var $_country;
    var $_plz;
    var $_city;

    function search() {
      $tables = "pools_pools";

      if(isset($this->wait) && $this->wait == 0) {
        if(isset($where)) $where .= " AND ";
        $where .= " (pools_pools.wait = 0) ";
      }

      if(isset($this->_is_located) && $this->_is_located == 1) {
        if(isset($where)) $where .= " AND ";
        $where .= " (pools_pools.is_located = 1) ";
      }
      else if(isset($this->_is_located)) {
        if(isset($where)) $where .= " AND ";
        $where .= " (pools_pools.is_located = 0) ";
      }

      if(isset($this->_is_public) && $this->_is_public == 1) {
        if(isset($where)) $where .= " AND ";
        $where .= " (pools_pools.is_public = 1) ";
      }
      else if(isset($this->_is_public)) {
        if(isset($where)) $where .= " AND ";
        $where .= " (pools_pools.is_public = 0) ";
      }
      

      if(isset($this->_user) && $this->_user != "all") {
        $tables .= ", pools_pools_user";
        $where .= " ((pools_pools.id = pools_pools_user.pool_id) AND (pools_pools_user.user_id = ".$this->_user."))";
        if($this->_wait == 0)
          $where .= " AND (pools_pools_user.wait = 0)";
      }

      if(isset($this->_admin)) {
        $tables .= ", pools_pools_admin";
        $where .= " ((pools_pools.id = pools_pools_admin.pool_id) AND (pools_pools_admin.user_id = ".$this->_admin."))";
      }

      if(isset($where))
        $where = " WHERE ".$where;

      if(isset($this->_order)) {
        $where .= " ORDER BY ".$this->_order;
      }
      $this->query("SELECT DISTINCT pools_pools.* FROM $tables $where");
    }
}
?>