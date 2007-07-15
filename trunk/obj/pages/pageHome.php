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
 * homepage
 */
 
require_once('./obj/pages/page.php');
require_once('./obj/forms/formLogin.php');
require_once('./obj/forms/formNewsData.php');
require_once('./obj/forms/formLostPassword.php');
 
class pageHome extends page{

    private $login_form;
	 private $res_count;
	 private $pool_count;
    private $footerlinks = array();
    private $newsform;
    private $shownews = array();
    private $lostpassword = false;
    private $pwform;

    public function pageHome() {
      $this->page();

      $this->setTemplate('homepage.tpl');

      $this->process();
      
      // output
      $this->assignAll();
      $this->display();
    }
    
    private function process() {
      $config = services::getService('config');
      $lang = services::getService('lang');
      $params = services::getService('pageParams');
	   $mail = services::getService('mail');
      
      // lost password      
      
      if($params->getParam('lostpassword') == 'true') {
        $this->lostpassword = true;
        
        $this->pwform = new formLostPassword('LostPassword');
        
        if($this->pwform->validate()) {
          // write email
          $user = new user;
          $user->email = $this->pwform->exportValue('email');
          $user->find(true);
          
          $mail->send('lostpassword', $user->email, $user->password);
          $user->password = crypt($user->password, 'dl');
          $user->update();
          
          $this->switchPage('home&msg=msg_pw_sent');
        }
      }
      else 
      
      // newsscript: write news
      
      if($params->getParam('news') == 'writenews') {
        
        $newsform = new formNewsData("newsdata");
        
        if($newsform->validate()) {
          $new_news = new news;
          $new_news->name = convertNewsSubmits($newsform->exportValue('newsname'));
          $new_news->abstract = convertNewsSubmits($newsform->exportValue('newsabstract'));
          $new_news->text = convertNewsSubmits($newsform->exportValue('newstext'));
          $new_news->date = time();
          $new_news->lang = $newsform->exportValue('newslang');

          $new_news->insert();
          
          $newsform->freezeForm();
          $this->addMsg('msg_news_submitted');
        }
        
        $this->newsform = $newsform;
        
      }
      
      // newsscript: show news headlines
      
      $shownews = new news;
      $shownews->lang = $lang->getLang();
      $shownews->orderBy('date DESC');
      $shownews->find();
      
      while($shownews->fetch()) {
        $this->shownews[] = array('name' => $shownews->name,
                                  'abstract' => $shownews->abstract,
                                  'text' => $shownews->text,
                                  'date' => date('d. m. Y', $shownews->date),
                                  'id' => $shownews->id);
      }
      
      // Instantiate the HTML_QuickForm object
      $this->login_form = new formLogin('LoginForm');
	  
	  // count resources and pools
	  $pool_count = new pools;
	  $res_count = new resources;
	  
	  $pool_count->wait = 0;
	  
	  $pool_count->find();
	  $res_count->find();
	  
	  $this->pool_count = 0;
	  while($pool_count->fetch())
	    ++$this->pool_count;
	  
	  $this->res_count = 0;
	  while($res_count->fetch())
	    ++$this->res_count;

      // Try to validate a form 
      if ($this->login_form->validate()) {
        if(loginCorrect($this->login_form->exportValue('login'), $this->login_form->exportValue('loginpassword'))) {
          $session = services::getService('pageParams');
          
          $session->addParam('login', $this->login_form->exportValue('login'), 'session');
          $session->addParam('password', $this->login_form->exportValue('loginpassword'), 'session');
          $session->addParam('msg', 'msg_login_correct', 'page');
		  
          $this->switchPage('mysite');
        }  
        else {
          $this->addMsg('msg_login_wrong');
        }
      }
      else {
        if(isset($this->user))
          $this->switchPage('logout');
      }
    }
    
    private function assignAll() {
      $tpl_engine = services::getService('tpl');
      $lang = services::getService('lang');

      // msg
      $tpl_engine->assign('msg', $this->getMsg());

      // Set formular-templates
      $renderer = new rendererLogin();
      $renderer_news = new renderer();
      
  
      // Output the form
      if($this->newsform) {
        $this->newsform->accept($renderer_news);
        $tpl_engine->assign('newsform', $renderer_news->toHtml());
      }
      $this->login_form->accept($renderer);
      $tpl_engine->assign('login_form', $renderer->toHtml());

      if($this->lostpassword) {
      $renderer_pw = new renderer();
      $this->pwform->accept($renderer_pw);
      $tpl_engine->assign('pwform', $renderer_pw->toHtml());}

      // footerlinks
      $tpl_engine->assign('msg', $this->getMsg());
      $tpl_engine->assign('shownews', $this->shownews);
      $tpl_engine->assign('lostpassword', $this->lostpassword);
      $tpl_engine->assign('res_count', $this->res_count);
      $tpl_engine->assign('pool_count', $this->pool_count);
    }
    
}
?>