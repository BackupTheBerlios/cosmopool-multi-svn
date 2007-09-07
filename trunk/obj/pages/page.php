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
 * base page-class the other page extend
 */
 
class page {

    private $msg;
    private $template;
    private $act_page;
    private $act_get;
    public $user;

    public function page() {
      $page_params = services::getService('pageParams');
      $config = services::getService('config');

      $login = $page_params->getParam('login');
      $password = $page_params->getParam('password');

      $this->act_page = $page_params->getParam('page');
      $this->act_get = $this->getActGet();
      
      // set interface-language
      // if lang is in get, a cookie is set, lang in get is set
      // else if lang is in cookie, lang in cookie is set
      // else if lang is in browser, a cookie is set etc.
      // else if lang is in config.ini, cookie, set
      if($_GET['lang']) {
        setcookie('language', $_GET['lang'], time()+60*60*24*365);
      }
      else if($_COOKIE['language']) {;
      }
      else if(is_array(parseHttpAcceptLanguage())) {
        $blang = parseHttpAcceptLanguage();
        setcookie('language', $blang[0]['code'], time()+60*60*24*365);
      }
      else {
        setcookie('language', $config->getSetting('language'), time()+60*60*24*365);
      }

      if(($login != "") && ($password != "")){
        $user = new user($login, crypt($password, 'dl'));
        if($user->find(true))
          $this->user = $user;
      }
      $this->addMsg($page_params->getParam('msg'));
      
      $this->assignAll();
    }
    
    public function addMsg($msg) {
      if($msg) {
        $lang = services::getService('lang');
        $this->msg .= ' '.$lang->getMsg($msg);
      }
    }
    
    public function getMsg() {
      if($this->msg != "")
        return $this->msg;
    }
    
    public function display() {
      $tpl_engine = services::getService('tpl');

	  
	  header('Content-type: text/html; charset=utf-8');
      $tpl_engine->display($this->template);
    }

    public function setTemplate($page) {
      $this->template = $page;
    }
    
    public function getActGet() {
      $page_params = services::getService('pageParams');
      $getparams = $page_params->getGetParams();
      
      $get = "";
      if(is_array($getparams))
        foreach($getparams as $key => $value) {
          if($key != 'lang')
            $get .= '&'.$key.'='.$value;
        }
      if(isset($_POST['page']))
        $get .= '&page='.$_POST['page'];
      return $get;
    }
    
    public function switchPage($page) {
      $page_params = services::getService('pageParams');
      $config = services::getService('config');

      //echo "<meta http-equiv=refresh content=0; URL=".$config->getSetting('url')."index.php?page=".$page.">";
      header('Location: '.$config->getSetting('url').'index.php?page='.$page);
      exit();
    }
    
    private function assignAll() {
      $tpl_engine = services::getService('tpl');
      $lang = services::getService('lang');
      $page_params = services::getService('pageParams');

      $act_lang = $lang->getLang();
      
      $languages = array('de', 'en', 'es');
      $assign_languages = array();
      foreach($languages as $language)  {
        if($language != $act_lang) {
          $assign_languages[] = $language; }}
          
      $tpl_engine->assign('act_lang', $act_lang);
      $tpl_engine->assign('page', $page_params->getParam('page'));
      $tpl_engine->assign('other_lang', $assign_languages);
      
      $tpl_engine->assign('act_page', $this->act_page);
      $tpl_engine->assign('act_get', $this->act_get);
      $tpl_engine->assign('is_logged_in', $this->user->login);
      
      $tpl_engine->register_object('lang',$lang);
    }
}
?>