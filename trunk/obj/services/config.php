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
 * config-service
 */
 
class config {

    private static $settings = array();
 
    // constructor
    public function config() {
      self::$settings = parse_ini_file('./config/config.ini', true);
    }
    
    public function getSetting($name) {
      if(isset(self::$settings[$name]))
        if ($name == "url") {
          $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
          return 'http://'.substr($url, 0, strrpos ($url, '/') + 1);
        }
        else
          return self::$settings[$name];
      else
        return false;
    }
    
}
?>