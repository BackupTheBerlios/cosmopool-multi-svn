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
 * Renderer extension
 */
require_once 'obj/ui/tables/tableSort.php';

class tablePools extends HTML_Table {

    // constructor
    function __construct() {
      $lang = services::getService('lang');

      // table-header
      parent::__construct(array("width" => "100%", "class" => "pools"));

      $this->setHeaderContents(0, 0, $lang->getMsg('tableheaders_name')); 
      $this->setHeaderContents(0, 1, $lang->getMsg('tableheaders_area'));
      $this->setHeaderContents(0, 2, $lang->getMsg('tableheaders_adress'));
      $this->setHeaderContents(0, 3, $lang->getMsg('tableheaders_is_public'));
      $this->setRowAttributes(0, array("class" => "pools"));
    }
    
}
?>