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
 * Login Form
 */

require_once './obj/forms/form.php';
require_once './obj/forms/renderer.php';

class formNewsData extends form {

    // constructor
    function formNewsData($name) {
      $lang = services::getService('lang');
      $params = services::getService('pageParams');
      $cats = services::getService('cats');
    
      $this->form($name);

      // Add some elements to the form
      $this->addElement('text', 'newsname', $lang->getMsg('home_news_name'), array('size' => 30, 'maxlength' => 100));
      $this->addElement('text', 'newslang', $lang->getMsg('home_news_lang'), array('size' => 30, 'maxlength' => 100));
      $this->addElement('textarea', 'newsabstract', $lang->getMsg('home_news_abstract'), array('rows' => 5, 'cols' => 100));
      $this->addElement('textarea', 'newstext', $lang->getMsg('home_news_text'), array('rows' => 30, 'cols' => 100));
      $this->addElement('submit', 'newssubmit', $lang->getMsg('home_news_submit'));
      $this->addElement('hidden', 'news', 'writenews');
      $this->addElement('hidden', 'page', 'home');
    }
    
	 function freezeForm() {
	   $this->removeElement('newssubmit');
 	   $this->freeze();
	 }
    
}

?>