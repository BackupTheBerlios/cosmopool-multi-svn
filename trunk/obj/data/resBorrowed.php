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
 * Table Definition for pools_res_borrowed
 */
require_once 'DB/DataObject.php';

class resBorrowed extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    var $__table = 'pools_res_borrowed';              // table name
    var $id;                              // int(8)  not_null primary_key unsigned auto_increment
    var $user_id;                         // int(6)  not_null unsigned
    var $res_id;                          // int(8)  not_null unsigned

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('data_obj_Pools_res_borrowed',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
    function fetchRes() {
      $this->res = new resources;
      $this->res->get($this->res_id);
    }
}
?>