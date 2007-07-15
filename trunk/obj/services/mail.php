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
 * mail-class
 */
 
class mail {
 
    private $subject;
    private $body;
 
    function replaceVar($var, $to) {
      $this->body = str_replace('['.$var.']', $to, $this->body);
      $this->subject = str_replace('['.$var.']', $to, $this->subject);
    }

    function send($type, $to, $obj = false, $obj2 = false) {
      $config = services::getService('config');
      $lang = services::getService('lang');

      $admin_email = $config->getSetting('email');

      $this->subject = $lang->getMsg('mails_'.$type.'_header');
      $this->body = $lang->getMsg('mails_'.$type.'_body').$lang->getMsg('mails_goodbye');

      // replace variables
      
      if($type == "registered") {
        $this->replaceVar('USERNAME', $obj->name);
        $this->replaceVar('PASSWORD', $obj2);
      }
      
      if($type == "lostpassword") {
        $this->replaceVar('PASSWORD', $obj);
      }
      
      if($type == "give_order") {
        $this->replaceVar('RESNAME', $obj->name);
      }
      
      if($type == "borrow_order") {
        $this->replaceVar('RESNAME', $obj->name);
      }
      
      if($type == "nogood_order") {
        $this->replaceVar('RESNAME', $obj->name);
      }
      
      if($type == "user_accepted") {
        $this->replaceVar('POOLNAME', $obj->name);
      }
      
      if($type == "user_refused") {
        $this->replaceVar('POOLNAME', $obj->name);
      }

      if($type == "new_member") {
        $this->replaceVar('POOLNAME', $obj->name);
      }

      if($type == "give_accepted") {
        $this->replaceVar('RESNAME', $obj->name);
      }

      if($type == "nogood_accepted") {
        $this->replaceVar('RESNAME', $obj->name);
      }
	  
      if($type == "borrow_accepted") {
        $this->replaceVar('RESNAME', $obj->name);
      }

      if($type == "refused") {
        $this->replaceVar('RESNAME', $obj->name);
      }
	  
      if($type == "kick_member") {
        $this->replaceVar('POOLNAME', $obj->name);
      }
	  
      if($type == "new_admin") {
        $this->replaceVar('POOLSNAME', $obj->name);
      }
	  
      mb_internal_encoding('UTF-8');

      $subject = mb_encode_mimeheader($this->subject,"UTF-8","Q");
      $body = $this->body;

      $headers  = "Reply-To: whopools.net <".$admin_email.">\r\n";
      $headers .= "From: whopools.net <".$admin_email.">\r\n";
      $headers .= "MIME-Version: 1.0\r\n";
      $headers .= "Content-type: text/plain; charset=utf-8\r\n";
      $headers .= "X-Mailer: php";

      mail($to, $subject, $body, $headers);
    }
    
}
?>