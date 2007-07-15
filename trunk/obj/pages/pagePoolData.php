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
 * res browser
 */
 
require_once('./obj/pages/pageCommon.php');
require_once('./obj/forms/formPoolData.php');
 
class pagePoolData extends pageCommon{

    private $form;
    private $header;
    private $new_admins;
    private $kick_user;
    private $pool;
    private $change_success_link;

    public function pagePoolData() {
      $this->pageCommon();
      
      $this->setTemplate('pooldata.tpl');

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
      $categories = services::getService('cats');
      $mail = services::getService('mail');

      $form = new formPoolData('FoundForm');

      if($params->getParam('pool_id')) {
      
        $pool = new pools;
        $pool->get($params->getParam('pool_id'));

        if(!$pool->isAdmin($this->user->id)) {
          $this->switchPage('mysite');    
        }

        // defaults
        $form->setDefaults(array(
          'poolname' => $pool->name,
          'pooldesc' => $pool->description,
          'poolarea' => $pool->area,
          'poolcountry' => $pool->country,
          'pooladress' => array(
          'plz1' => substr($pool->plz, 0, 2),
          'plz2' => substr($pool->plz, 2, 3),
          'city' => $pool->city),
          'is_public' => $pool->is_public
        ));
        
        $this->pool = $pool;

        $this->header = $pool->name.$lang->getMsg('pooldata_header_change');
      }
      else 
        $this->header = $pool->name.$lang->getMsg('pooldata_header_found');
      
      // Try to validate a form 
      if ($form->validate()) {
        if(!isset($pool))
          $pool = new pools;

        $pool->name = $form->exportValue('poolname');
        $pool->description = $form->exportValue('pooldesc');
        $pool->area = $form->exportValue('poolarea');
        $pool->country = $form->exportValue('poolcountry');
        $adress2 = $form->getElementValue('pooladress');
        $pool->plz = $adress2['plz1'].$adress2['plz2'];
        $pool->city = $adress2['city'];
        $pool->is_public = $form->exportValue('is_public');
        //$pool->is_located = $form->exportValue('is_located');

        if(isset($pool->id)) {
          $pool->update();

          $this->addMsg('msg_data_change_success');
          $form->freezeForm();
          $this->change_success_link = true;
        }
        else {
          $pool->wait = 1;
          $pool->insert();
          
          $new_user = new poolsUser;
          $new_user->user_id = $this->user->id;
          $new_user->pool_id = $pool->id;
          $new_user->wait = 0;
          $new_user->insert();

          $new_admin = new poolsAdmin;
          $new_admin->user_id = $this->user->id;
          $new_admin->pool_id = $pool->id;
          $new_admin->insert();

          $params->addParam('msg', 'msg_found_success', 'page');
          $mail->send('found_pool_admin', $config->getSetting('email'));
          $mail->send('found_pool_founder', $this->user->email);
          $this->switchPage('mysite');
        }
      }

      $this->form = $form;
    }
    
    private function assignAll() {
      $this->commonAssign();
      
      $tpl_engine = services::getService('tpl');
      $lang = services::getService('lang');

      // Output the form
      $renderer = new renderer;

      $this->form->accept($renderer);
      $tpl_engine->assign('form', $renderer->toHtml());

      $tpl_engine->assign('header', $this->header);
      $tpl_engine->assign('change_success_link', $this->change_success_link);
      if(isset($this->pool))
        $tpl_engine->assign('pool', $this->pool);
      else
        $tpl_engine->assign('found', true);
    }
    
}
?>