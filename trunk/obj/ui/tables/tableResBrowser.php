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

class tableResBrowser extends tableSort {

    private $count = 1;
	 private $get_add;

    // constructor
    function __construct($data, $get_add) {

      parent::__construct(array("width" => "100%", "class" => "pools"), "show_res", "index.php?page=resbrowser");

      $params = services::getService('pageParams');
      $lang = services::getService('lang');

      $this->get_add = $get_add;

      // table-header
      $this -> setHeaderContents(0, 0, $lang->getMsg('tableheaders_what'),$get_add,'name');
      $this -> setHeaderContents(0, 1, $lang->getMsg('tableheaders_owner'),$get_add);
	   if($data[0]['type'] != 0)
        $this -> setHeaderContents(0, 2, $lang->getMsg('tableheaders_type'),$get_add);


      foreach($data as $row) {
		
		if (!$row['detail']) {
		
		  $this->processRow($row);
		  
		} else {
		
		  $this->processDetailRow($row);
		}
		++$this->count;
      }

      $this -> updateColAttributes(0, array("class" => "pools"));
      $this -> updateColAttributes(1, array("width" => "100", "class" => "pools"));
	   if($data[0]['type'] != 0)
        $this -> updateColAttributes(2, array("width" => "60", "class" => "pools"));
    }
	
	private function processRow($row) {
     $params = services::getService('pageParams');

     $lang = services::getService('lang');
	
	  if($row['available'])
	    $title = '<b><a href="index.php?page=resbrowser&amp;show_page='.$params->getParam('show_page').'&amp;res_id=' . $row['res_id'] . $this->get_add.'#detailrow">' . $row['name'] . '</a></b>';
	  else
	    $title = '<b><a href="index.php?page=resbrowser&amp;show_page='.$params->getParam('show_page').'&amp;res_id=' . $row['res_id'] . $this->get_add.'#detailrow">' . $row['name'] . '</a></b>(<font class="msg">'.$lang->getMsg('tables_borrowed').'</font>)';

	  $first_col = "$title\n";
	  
	  
	  $type_resolved = $this->resolveType($row['type']);
	  
	  //$user_name
	
	  $this -> setCellContents($this->count, 0, $first_col);
	  $this -> setCellContents($this->count, 1, $row['user_name']);
	  if ($row['type'] != 0) 
		$this -> setCellContents($this->count, 2, $type_resolved);
	}
	
	private function processDetailRow($row) {
     $lang = services::getService('lang');
     
     $title = '<b id="detailrow">'.$row['name'].'</b>';
	  $desc = $row['description'];
	  if(is_array($row['attributes'])) {
	    foreach($row['attributes'] as $attribute) {
	       $attr_fields .= '<b>'.$lang->getMsg('resdata_form_'.$attribute['name']).': </b> '.$attribute['value'].'<br>';
	    }
	  }

	  if(!$row['available'])
	    $do = '<font class="msg">'.$lang->getMsg('tables_allready_borrowed').'</font>';
	  else if($row['is_waiting'])
	    $do = '<font class="msg">'.$lang->getMsg('tables_request_running').'</font>';
      else
	    $do = '<b>'.$lang->getMsg('tables_comment_for_the_owner').': </b><br>
	         <input type="hidden" name="id" value="'.$row['res_id'].'">
			   <textarea name="comments" cols="30" rows="5"></textarea><br>
	         <input type="submit" name="submit" value="'.$this->resolveType($row['type']).'">';
	  if($row['prove_public'] == false)
	    $contact = '<b>'.$lang->getMsg('tables_contactdata').'</b><br>'.
	                $row['user_name'].'<br>'.
	                $row['user_street'].' '.$row['user_house'].'<br>'.
	                $row['user_plz'].' '.$row['user_city'].'<br>'.
	                $row['user_email'].'<br>'.
	                $row['user_phone'];
	  else if($row['own_ressource']) {
	    $contact = '<b>'.$lang->getMsg('tables_contactdata').'</b><br>
		            '.$lang->getMsg('tables_contactdata_youdontneed');
		$do = "";
	  }
	  else
	    $contact = '<b>'.$lang->getMsg('tables_contactdata').'</b><br>
		            '.$lang->getMsg('tables_contactdata_isinvisible');

	  $first_col = "$title<br>\n$desc<br><br>\n$attr_fields<br>\n$contact<br><br>\n$do";
	  
	  $this -> setCellContents($this->count, 0, $first_col);
	  if($row['type'] != 0)
        $this -> updateCellAttributes($this->count, 0, array("colspan" => "3"));
	  else
	    $this -> updateCellAttributes($this->count, 0, array("colspan" => "2"));
	}
	
	private function resolveType($type) {
      $lang = services::getService('lang');
	    switch ($type) {

            // no item
            case 0:
            $action = $lang->getMsg('tables_contactbutton_noitem');
            break;

            // be given
            case 1:
            $action = $lang->getMsg('tables_contactbutton_gift');
            break;

            // borrow
            case 2:
            $action = $lang->getMsg('tables_contactbutton_borrow');
            break;
        }
		return $action;
	}
    
}
?>