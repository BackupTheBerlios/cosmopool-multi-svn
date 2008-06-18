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
 
require_once './obj/services/lang_de.php';
require_once './obj/services/lang_es.php';
require_once './obj/services/lang_en.php';

class lang {

    public $languages = array('de', 'es', 'en');
    public $msg = array();
    public $lang = "";

    // constructor
    public function lang() {
      $config = services::getService('config');
      $params = services::getService('pageParams');
      global $lang_de;
      global $lang_es;
      global $lang_en;
      $this->msg = array("de" => $lang_de, "en" => $lang_en, "es" => $lang_es);
          
      // if there's a lang_cookie, the cookie-language is chosen
      if($_GET['lang']) {
        $this->lang = $_GET['lang'];
      }
      else if($_COOKIE['language']) {
        $this->lang = $_COOKIE['language'];
      }
      else if(is_array(parseHttpAcceptLanguage())) {
        $blang = parseHttpAcceptLanguage();
        $this->lang = $blang[0]['code'];
      }
      else {
        $this->lang = $config->getSetting('language');
      }
      if(!in_array($this->lang, $this->languages)) {
        $this->lang = $config->getSetting('language');
      }
    }
    
    public function getMsg($name, $special_lang = "") {
      $config = services::getService('config');

      $language = $this->lang;
      if(in_array($special_lang, $this->languages)) 
        $language = $special_lang;
        
      if(is_array($name)) 
        $name = $name['p1'];
        
      if(isset($this->msg[$language][$name])) {
        $msg = $this->msg[$language][$name];
        return $msg;
      } else if(isset($this->msg[$config->getSetting('language')][$name])) {
        $msg = $this->msg[$config->getSetting('language')][$name];
        return $msg;
      } else {
        return "msg doesn't exist: ".$name;
      }
    }
    
    public function getLang() {
      return $this->lang;
    }
    
}
?>