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
require_once 'HTML/Table.php';

class table extends HTML_Table
{

    var $table_name;
    var $page_name;

    // constructor
    function __construct($attributes, $table_name, $page_name) {

      // table-header
      parent::__construct($attributes);
      $this->setAutoGrow(true);
      $this->setAutoFill(" ");
    }
    
    function setHeaderContents($y, $x, $content) {
      parent::setHeaderContents($y, $x, $content);
    
    }

}
?>