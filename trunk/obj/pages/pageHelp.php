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
 
require_once('./obj/pages/pageCommon.php');
 
class pageHelp extends pageCommon{

    private $login_form;
    private $help_content;
    private $headlines = array();

    public function pageHelp() {
      $this->pageCommon();

      $this->setTemplate('help.tpl');

      $this->process();

      // output
      $this->assignAll();
      $this->display();
    }
    
    private function replaceCode($text, $code, $replacement1, $replacement2) {
      if(strripos($text, $code)) {
        $sub1 = substr($text, 0, strripos($text, $code));
        $sub2 = substr($text, strripos($text, $code));
      
        $text = str_ireplace($code, $replacement1, $sub1).str_ireplace($code, $replacement2, $sub2);

        return $text;
      }
      else return false; 

    }
    
    private function process() {
      $this->commonProcess();
      
      $lang = services::getService('lang');
      
      $lines = preg_split('/\n/', $lang->getMsg('help_content'));
            
      $headline_count = 0;
      foreach($lines as $line) {
      if(!$line == "") {
        if(!($this->replaceCode($line, '===', '<p class="headline3">', '</p>') === false))
          $line = $this->replaceCode($line, '===', '<p class="headline3">', '</p>');
        if(!($this->replaceCode($line, '==', '<p class="headline2">', '</p>') === false)){
          $this->headlines[] = str_ireplace('==', '', $line);
          ++$headline_count;
          $line = $this->replaceCode($line, '==', '<hr><div align="right"><a href="#">top</a></div><p class="headline2" id="'.$headline_count.'">', '</p>');
        }
        else
          $line = '<p class="standard">'.$line.'</p>';
        
        $text .= $line.'
        ';
      }}
      
      $this->help_content = $text;
    }

    private function assignAll() {
      $this->commonAssign();

      $tpl_engine = services::getService('tpl');
      $lang = services::getService('lang');
      
      $tpl_engine->assign('header', $lang->getMsg('help_header'));
      $tpl_engine->assign('headlines', $this->headlines);
      $tpl_engine->assign('help_content', $this->help_content);
    }
    
}
?>