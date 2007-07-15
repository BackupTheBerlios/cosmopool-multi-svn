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
require_once 'HTML/QuickForm/Renderer/Default.php';

class rendererUserdata extends HTML_QuickForm_Renderer_Default
{

    // constructor
    function rendererUserdata() {
      include './tpl/tables.php';
      
      $this->HTML_QuickForm_Renderer_Default();
      $this->setHeaderTemplate($userdata_default_header);
      $this->setElementTemplate($userdata_default_element);
      $this->setRequiredNoteTemplate($userdata_default_required_note);
      $this->setElementTemplate($userdata_element, 'submit');
    }
    
}
?>