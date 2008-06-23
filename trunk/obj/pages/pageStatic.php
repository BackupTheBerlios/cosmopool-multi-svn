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
 
class pageStatic extends pageCommon{

    // variables
    
    private $categories = array();
    private $text;
    private $pagename;
    
    // contructor

    public function pageStatic($pageid) {
      $this->pageCommon();
      
      $this->setTemplate('static.tpl');

      $this->process($pageid);

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
    
    private function process($pageid) {
      $this->commonProcess();
      $lang = services::getService('lang');
    
      require_once('./obj/pages/texts.php');
      
      if(!$texts[$lang->getLang()][$pageid]['text'])
        $pageid = "error";
      $lines = preg_split('/\n/', $texts[$lang->getLang()][$pageid]['text']);
            
      foreach($lines as $line) {
      if(!$line == "") {
        if(!$text)
          $line = $line;
        else {
        if(!($this->replaceCode($line, '===', '<p class="headline3">', '</p>') === false))
          $line = $this->replaceCode($line, '===', '<p class="headline3">', '</p>');
        if(!($this->replaceCode($line, '==', '<p class="headline2">', '</p>') === false)){
          $line = $this->replaceCode($line, '==', '<hr><div align="right"><a href="#">top</a></div><p class="headline2">', '</p>');
        }
        else
          $line = '<p class="standard">'.$line.'</p>';
        }
        
        $text .= $line.'
        ';
      }}

      $this->text = $text;
      $this->pagename = $texts[$lang->getLang()][$pageid]['title'];

      // category-stuff
      
      if(is_array($texts[$lang->getLang()][$pageid]['links']))
      
      foreach($texts[$lang->getLang()][$pageid]['links'] as $link) {
        $this->categories[] = $link;
      }
    }
    
    private function assignAll() {
      $this->commonAssign();

      $tpl_engine = services::getService('tpl');

      $tpl_engine->assign('header', $this->pagename);
      $tpl_engine->assign('text', $this->text);
    }
    
}
?>