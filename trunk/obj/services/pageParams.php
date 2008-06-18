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
 * post and get-handle
 */
 session_start();

class pageParams {

    private static $params = array();
    private static $params_get = array();
 
    // constructor
    function __construct() {
      $this->updateParams();
    }
    
    function unsetParams() {
      if(isset($this->params['to_be_unset']) && is_array($this->params['to_be_unset'])) { 
        foreach($this->params['to_be_unset'] as $param => $dontmatter) 
          session_unregister($param);
        session_unregister('to_be_unset');
      }
    }

    function unsetParam($name) {
      session_unregister($name);
      setcookie($name, '', time()-86400);
    }
    
    function updateParams() {    
      global $_POST;
      global $_GET;
      global $_SESSION;
      global $_COOKIE;
      
      $this->params = "";
      $this->params = array();
      
      foreach($_SESSION as $param => $value) {
        $this->params[$param] = $value;
      }
      foreach($_GET as $param => $value) {
        $this->params[$param] = $value;
        $this->params_get[$param] = $value;
      }
      foreach($_POST as $param => $value) {
        $this->params[$param] = $value;
      }
      foreach($_COOKIE as $param => $value) {
        $this->params[$param] = $value;
      }

    }
    
    public function getParam($name) {
      if(isset($this->params[$name])) 
        return $this->params[$name];
      else
        return false;
    }
    
    public function getGetParams() {
      return $this->params_get;
    }
    
    // period means how long the parameter will exist.
    // until the next page('page'), or the whole session('session')
    // 'now' is this page
    public function addParam($name, $value, $period) {
      global $_SESSION;
      
      if($period == 'now') {
        $this->params[$name] = $value;
      }
      else{
      $_SESSION[$name] = $value;
      if($period == 'page') {
        if(!is_array($_SESSION['to_be_unset']))
          $_SESSION['to_be_unset'] = array();
        $_SESSION['to_be_unset'][$name] = true;
        unset($this->params['to_be_unset'][$name]);
      }}
    }

}

?>