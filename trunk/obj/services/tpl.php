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
 * smarty template-service
 */
 
// load Smarty
require_once('Smarty.class.php');

class tpl extends Smarty {

   public function tpl()
   {
     $config = services::getService('config');
   
     $this->Smarty();

	  $this->template_dir = $config->getSetting('doc_root').'tpl/';
	  $this->compile_dir = $config->getSetting('doc_root').'tpl/cache/';
	  $this->config_dir = $config->getSetting('doc_root').'config/';
	  $this->cache_dir = $config->getSetting('doc_root').'cache/'; 
		
	  $this->caching = false;
   }

}
?>