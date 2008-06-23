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
 * Table Definition for pools_collectives_time
 */
require_once 'DB/DataObject.php';

class pm extends DB_DataObject 
{
    var $sender;
    var $recipient;
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    var $__table = 'pools_pm';          // table name
    var $id;
    var $sender_id;
    var $recipient_id;
    var $title;
    var $body;
    var $is_read;
    var $is_in_draft;
    var $date;
    var $sender_delete;
    var $recipient_delete;

    /* ZE2 compatibility trick*/
    function __clone() { return $this;}

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('data_obj_Pools_collectives_time',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
    
    function fetchSender() {
      $this->sender = new user;
      $this->sender->id = $this->sender_id;
      $this->sender->find(true);
    }
    
    function fetchRecipient() {
      $this->recipient = new user;
      $this->recipient->id = $this->recipient_id;
      $this->recipient->find(true);
    }

    function getDate() {
      return date('j.n.Y, H:i', $this->date);
    }
}
?>