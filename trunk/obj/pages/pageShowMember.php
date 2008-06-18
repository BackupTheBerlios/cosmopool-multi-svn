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
 * my site
 */
 
require_once('./obj/pages/pageCommon.php');
 
class pageShowMember extends pageCommon{

    private $pool;
    private $member;
    private $not_member;

    public function pageShowMember() {
      $this->pageCommon();
      
      $this->setTemplate('showmember.tpl');
      $this->process();

      // output
      $this->assignAll();
      $this->display();
    }
    
    private function process() {
      $this->commonProcess();
    
      $config = services::getService('config');
      $lang = services::getService('lang');
      $params = services::getService('pageParams');
      $mail = services::getService('mail');
      $geo = services::getService('geoinfo');
      $categories = services::getService('cats');
      
      if($params->getParam('add_to_adressbook')) {
        $addr = new adressbook;
        $addr->sender_id = $this->user->id;
        $addr->recipient_id = $params->getParam('showmember');
        if(!$addr->find()) {
          $addr->insert();
          $this->addMsg('msg_adressbook_add_success');
        } else
          $this->addMsg('msg_adressbook_add_allready');
      }
      
	   // build userlist
	   
	   // assotiativ array with object and detail-flag
	   	   
	   $smember = new user;
	   $smember->id = $params->getParam('showmember');
	   $smember->find(true);
			  
		$member = array("obj" => $smember);
		$this->member = $member;
		$this->member['obj']->getPhoto();
		  
		$this->geodist = $geo->getDistance($this->user, $this->member["obj"]);
    }
    
    private function assignAll() {
      $this->commonAssign();
      
      $tpl_engine = services::getService('tpl');
      $lang = services::getService('lang');
      
      if($this->member['obj']->plz_city_public || $this->member['obj']->description || $this->member['obj']->phone_public || $this->member['obj']->email_public)
        $tpl_engine->assign('one_public', true);
      else
        $tpl_engine->assign('one_public', false);

      if($this->member['obj']->photo) 
        $tpl_engine->assign('photo', $this->member['obj']->photo);
      $tpl_engine->assign('header', $this->member['obj']->name);
      $tpl_engine->assign('member', $this->member);
      $tpl_engine->assign('geodist', $this->geodist);
    }
    
}
?>