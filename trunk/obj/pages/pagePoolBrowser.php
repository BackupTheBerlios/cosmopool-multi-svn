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
require_once('./obj/ui/tables/tablePools.php');
 
class pagePoolBrowser extends pageCommon{

    private $header;
    private $table;

    public function pagePoolBrowser() {
      $this->pageCommon();
      
      $this->setTemplate('poolbrowser.tpl');

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
      
      $table = new tablePools;

      // fetch "Pool"
      
      $pools_pool = new pools;
      $pools_pool->name = "Pool";
      $pools_pool->find(true);

      $table->addRow(array('<a href="./index.php?page=showpool&pool_id='.$pools_pool->id.'&cat=0&type=0">'.$pools_pool->name.'</a>', $pools_pool->area, " ", $lang->getMsg('tables_is_public_yes')), array("class" => "pools"));

      // other pools

      $pools = new poolsFetcher;
      $pools->_user = $params->getParam('pools');

      $order = "country,plz";
      $pools->_order = $order;

      $pools->search();
      $act_country = 'none';

      while($pools->fetch()) {
        if(!($pools->name == "Pool")) {
        
          // country headlines
          if($pools->country != $act_country) {
            if($pools->country == '0') {
              $table->addRow(array('&nbsp;'), array("color" => "white", "colspan" => "2"));
              $table->addRow(array('<b>'.$lang->getMsg('showpool_nocountry_header').'</b>'), array("class" => "poolsblank", "colspan" => "2"));
            }
            else {
              $table->addRow(array('&nbsp;'), array("color" => "white", "colspan" => "2"));
              $table->addRow(array('<b>'.$lang->getMsg('country_'.$pools->country).'</b>'), array("class" => "poolsblank", "colspan" => "2"));
            }
            $lastplz = true;
            $act_country = $pools->country;
          }
          if($pools->plz && !$lastplz) {
            $table->addRow(array('&nbsp;'), array("color" => "white", "colspan" => "2"));
          }

          if($pools->is_public == 1)
            $is_public_cell = $lang->getMsg('tables_is_public_yes');
          else
            $is_public_cell = $lang->getMsg('tables_is_public_no');
          if($pools->plz)
            $plz = $pools->plz;
          else
            $plz = false;
        
          $table->addRow(array('<a href="./index.php?page=showpool&pool_id='.$pools->id.'">'.$pools->name.'</a>', $pools->area, $plz.' '.$pools->city, $is_public_cell), array("class" => "pools"));
          $lastplz = $pools->plz;
        }
      }
      
      $this->table = $table;

      if($params->getParam('pools') == 'all')
        $this->header = $lang->getMsg('poolbrowser_all_header');
    }
    
    private function assignAll() {
      $this->commonAssign();
      
      $tpl_engine = services::getService('tpl');
      $lang = services::getService('lang');

      $tpl_engine->assign('header', $this->header);
      
      $tpl_engine->assign('poolstable', $this->table->toHTML());
    }
    
}
?>