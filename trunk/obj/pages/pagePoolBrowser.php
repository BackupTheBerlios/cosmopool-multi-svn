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

    private $function;
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
      
      // function is set
      
      if($params->getParam('function'))
        $this->function = $params->getParam('function');
      else
        $this->function = 'public';

      $table = new tablePools;
      
      if($this->function == 'public') {

      // fetch "Pool"
      
      $pools_pool = new pools;
      $pools_pool->id = 1;
      $pools_pool->find(true);
      $main_res = new resFetcher;
      $main_res->_pools = array(1);
      $table->addRow(array('<a href="./index.php?page=showpool&pool_id='.$pools_pool->id.'&cat=0&type=0">'.$pools_pool->name.'</a>', $pools_pool->area, " ", $main_res->count()), array("class" => "pools3"));
      
      }

      // other pools

      $pools = new poolsFetcher;

      if($this->function == 'public') {
        $pools->_is_public = 1;
      }
      else {
        $pools->_is_public = 0;
      }

      $order = "country,plz";
      $pools->_order = $order;

      $pools->search();
      $act_country = 'none';

      while($pools->fetch()) {
        if(!($pools->id == 1)) {
        
          // country headlines
          if($pools->country != $act_country) {
            if($pools->country == '0') {
              $table->addRow(array('&nbsp;'), array("color" => "white"));
              $table->addRow(array('<b>'.$lang->getMsg('showpool_nocountry_header').'</b>'), array("class" => "poolsblank"));
            }
            else {
              $table->addRow(array('&nbsp;'), array("color" => "white"));
              $table->addRow(array('<b>'.$lang->getMsg('country_'.$pools->country).'</b>'), array("class" => "poolsblank"));
            }
            $lastplz = true;
            $act_country = $pools->country;
          }
          if($pools->plz && !$lastplz) {
            $table->addRow(array('&nbsp;'), array("color" => "white"));
          }

          if($pools->plz)
            $plz = $pools->plz;
          else
            $plz = false;
        
          $rescount = new resFetcher;
          $rescount->_pools = array($pools->id);
          $table->addRow(array('<a href="./index.php?page=showpool&pool_id='.$pools->id.'">'.$pools->name.'</a>', $pools->area, $plz.' '.$pools->city, $rescount->count()), array("class" => "pools3"));
          $lastplz = $pools->plz;
        }
      }
      
      $this->table = $table;

      $this->header = $lang->getMsg('poolbrowser_all_header');
    }
    
    private function assignAll() {
      $this->commonAssign();
      
      $tpl_engine = services::getService('tpl');
      $lang = services::getService('lang');

      $tpl_engine->assign('header', $this->header);
      
      $tpl_engine->assign('function', $this->function);
      $tpl_engine->assign('poolstable', $this->table->toHTML());
    }
    
}
?>