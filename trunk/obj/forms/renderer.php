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

class renderer extends HTML_QuickForm_Renderer_Default
{

    // constructor
    function renderer() {
      include './tpl/tables.php';
      
      $this->default_header = $default_header;
      $this->default_element = $default_element;
      $this->required_note = $required_note;
      $this->submit_element = $submit_element;
      $this->endtable_element = $endtable_element;
      $this->begintable_element = $begintable_element;
      
      $this->HTML_QuickForm_Renderer_Default();
      $this->setHeaderTemplate($this->default_header);
      $this->setElementTemplate($this->default_element);
      $this->setElementTemplate($cat_element, 'resdata_cat');
      $this->setElementTemplate($isbn_element, 'resdata_isbn');
      $this->setElementTemplate($zipcode_element, 'pooladress');
      $this->setElementTemplate($isbn_submit_element, 'resdata_isbn_submit');
      $this->setRequiredNoteTemplate($this->required_note);
      $this->setElementTemplate($this->submit_element, 'submit');
    }
    
}
?>