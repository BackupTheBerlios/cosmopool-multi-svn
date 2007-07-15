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
 * QuickForms extension
 */
require_once 'HTML/QuickForm.php';
require_once './inc/formrules.php';

class form extends HTML_QuickForm {

    // constructor
    function form($name) {
      $page_params = services::getService('pageParams');
    
      $this->HTML_QuickForm($name);

      $this->registerRule('passcommon', 'callback', 'passwordCommon');
      $this->registerRule('passease', 'callback', 'passwordEase');
      $this->registerRule('userunique', 'callback', 'usernameUnique');
      $this->registerRule('logincorrect', 'callback', 'loginCorrect');
      
      $this->addElement('hidden', 'page', $page_params->getParam('page'));
    }
    
}

?>