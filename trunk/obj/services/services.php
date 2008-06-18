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
 * Singleton-Service-Factory
 */

require_once './obj/services/mail.php';
require_once './obj/services/lang.php';
require_once './obj/services/config.php';
require_once './obj/services/geoinfo.php';
require_once './obj/services/tpl.php';
require_once './obj/services/pageParams.php';
require_once './obj/services/cats.php';
require_once './obj/services/countries.php';

class services {

    private static $services = array();
    
    private function instanciateService($service_name) {
      switch ($service_name) {
        case 'mail':
          self::$services[$service_name] = new mail;
          break;
        case 'lang':
          self::$services[$service_name] = new lang;
          break;
        case 'pageParams':
          self::$services[$service_name] = new pageParams;
          break;
        case 'config':
          self::$services[$service_name] = new config;
          break;
        case 'tpl':
          self::$services[$service_name] = new tpl;
          break;
        case 'cats':
          self::$services[$service_name] = new cats;
          break;
        case 'countries':
          self::$services[$service_name] = new countries;
          break;
        case 'geoinfo':
          self::$services[$service_name] = new geoinfo;
          break;
      }
    }
  
    public static function getService($service_name) {
      if(!isset(self::$services[$service_name]))
        self::instanciateService($service_name);
      return self::$services[$service_name];
    }
  
}

?>