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

class pageResManager extends pageCommon{

    private $form;
    private $userres;
    private $function;

    public function pageResManager() {
      $this->pageCommon();
      
      $this->setTemplate('resmanager.tpl');

      $this->process();

      // output
      $this->assignAll();
      $this->display();
    }
    
    private function process() {
      $this->commonProcess();
    
	   $mail = services::getService('mail');
      $config = services::getService('config');
      $lang = services::getService('lang');
      $params = services::getService('pageParams');
      $categories = services::getService('cats');

      // use-res logics

      // accept inquiry
      if($params->getParam('action') == 'wait_res_accept') {
        $wait_res = new resWait;
        $wait_res->get($params->getParam('wait_id'));
        $wait_res->fetchRes();
  
        // no item
        if($wait_res->res->type == 0) {
            
          // delete all interessants
          $wait_res->res->deleteWaiting($wait_res->user_id);
		    $wait_res->fetchUser();

          $this->addMsg('msg_request_success');
          $mail->send('nogood_accepted', $wait_res->user->email, $wait_res->res);
         }

        // give
        if($wait_res->res->type == 1) {

          // res is given to the new owner
          $wait_res->res->changeOwner($wait_res->user_id);
		    $wait_res->fetchUser();

          // delete pool affiliations
          $wait_res->res->deletePools();

          // delete all interessants
          $wait_res->res->deleteWaiting();

          $this->addMsg('msg_give_success');
          $mail->send('give_accepted', $wait_res->user->email, $wait_res->res);
         }
          
        // borrow
        if($wait_res->res->type == 2) {

          // res is borrowed
          $wait_res->res->isBorrowed($wait_res->user_id);
		    $wait_res->fetchUser();
            
          // delete all interessants
          $wait_res->res->deleteWaiting();

          $this->addMsg('msg_borrow_success');
          $mail->send('borrow_accepted', $wait_res->user->email, $wait_res->res);
        }
        $this->toDoList();
      }

      // refuse inquiry
      if($params->getParam('action') == 'wait_res_refuse') {
        $wait_res = new resWait;
        $wait_res->id = $params->getParam('wait_id');
		  $wait_res->find(true);
		  $waiter = new user;
		  $waiter->get($wait_res->user_id);
		  $wait_res->fetchRes();
        $mail->send('refused', $waiter->email, $wait_res->res);
        $wait_res->delete();
        $this->toDoList();
      }

      // res is given back
      if($params->getParam('action') == 'res_back') {
        $bow_res = new resBorrowed;
        $bow_res->res_id = $params->getParam('res_id');
        if($bow_res->delete())
          $this->addMsg('msg_res_back');
      }

      // delete resources
      if($params->getParam('resdata_del_submit')) {
        foreach($_POST as $res_id => $doesnmatter) {
          $del_res = new resources;

          // delete res
          $del_res->id = $res_id;
    
          if($del_res->deleteAll()) {
            $deleted = true;
          }
        }
  
        // set $msg
        if($deleted)
          $this->addMsg('msg_delres_success');
      }

      $userres = new resFetcher;
      $userres->_order = "name";

      $userres->_user = $this->user->id;

      $userres->search();
      $this->userres = $userres->getAsArray();

      // borrowed res are shown
      $this->borrowed_res = $this->user->getBorrowedRes();

      // waiting res are shown
      $this->res_offers = $this->user->getWaitingRes();

      // function is set
      
      if($this->res_offers)
        $this->function = 'offers';
      else if($this->borrowed_res)
        $this->function = 'borrowed';
      else
        $this->function = 'all';
        
      if($params->getParam('function'))
        $this->function = $params->getParam('function');

      if((!$this->res_offers) && $this->function=='offers')
        $this->function = 'borrowed';
      if((!$this->borrowed_res) && $this->function=='borrowed')
        $this->function = 'all';
      
    }
    
    private function assignAll() {
      $this->commonAssign();
      
      $lang = services::getService('lang');
      $tpl_engine = services::getService('tpl');

      $tpl_engine->assign('function', $this->function);
      $tpl_engine->assign('userres', $this->userres);
      $tpl_engine->assign('res_offers', $this->res_offers);
      $tpl_engine->assign('borrowed_res', $this->borrowed_res);
      $tpl_engine->assign('header', $lang->getMsg('resmanager_header'));
    }
    
}
?>