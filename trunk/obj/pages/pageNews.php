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
 
class pageNews extends page{

    private $shownews = array();

    public function pageNews() {
      $lang = services::getService('lang');
      $params = services::getService('pageParams');

      $this->page();

      $this->setTemplate('news.tpl');

      // newsscript: show news headlines
      
      $shownews = new news;
      $shownews->id = $params->getParam('news_id');
      $shownews->find(true);
      
      $this->shownews = array('name' => $shownews->name,
                                  'abstract' => $shownews->abstract,
                                  'text' => $shownews->text,
                                  'date' => date('d. m. Y', $shownews->date),
                                  'id' => $shownews->id);

      // output
      $this->assignAll();
      $this->display();
    }
    
    private function assignAll() {
      $tpl_engine = services::getService('tpl');
      $lang = services::getService('lang');

      $tpl_engine->assign('shownews', $this->shownews);
    }
    
}
?>