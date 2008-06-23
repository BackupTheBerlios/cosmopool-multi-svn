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

class formInvite extends form {

    // constructor
    function formInvite($name, $user) {
      $lang = services::getService('lang');
      $params = services::getService('pageParams');
      $cats = services::getService('cats');
    
      $this->form($name);

      $this->addElement('textarea', 'emails', $lang->getMsg('invite_form_emails'), array('rows' => 5, 'cols' => 40));
      $this->addElement('textarea', 'message', $lang->getMsg('invite_form_message'), array('rows' => 7, 'cols' => 50));
      
      $free_pool = new poolsUser;
      $free_pool->user_id = $user->id;
      $free_pool->wait = 0;
      $free_pool->find();
      $free_pools = array();
      while($free_pool->fetch()) {
        $free_pool->fetchPool();
        $free_pools[] = &HTML_QuickForm::createElement('checkbox', $free_pool->pool->id, null, ' '.$free_pool->pool->name, $free_pool->pool->id);
      }
      $this->addGroup($free_pools, 'free_pools', $lang->getMsg('resdata_form_pools'), '<br>');
      $this->addElement('submit', 'submit', $lang->getMsg('resdata_form_submit'));
      
      $this->addRule('emails', $lang->getMsg('resdata_form_namenecessary'), 'required');
    }
	
}

?>