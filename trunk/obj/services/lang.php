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
 * language-service
 */
 
class lang {

    public $msg = array();

    // constructor
    public function lang() {
      ;
    }
    
    public function getMsg($name) {
      if(is_array($name)) {
        if(isset($this->msg[$name['p1']])) {
          $msg = $this->msg[$name['p1']];
          return $msg;
        }
      }
      else if(isset($this->msg[$name])) {
        $msg = $this->msg[$name];
        return $msg;
      }
      else
        return "msg doesn't exist: ".$name;
    }
    
    public function getLang() {
      return $this->lang;
    }
    
}
?>