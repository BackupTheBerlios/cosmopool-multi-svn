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

    function send($type, $to, $obj = false, $obj2 = false, $obj3 = false) {
      $config = services::getService('config');
      $lang = services::getService('lang');

      $admin_email = $config->getSetting('email');
      
      $from = "From: whopools.net <".$admin_email.">\r\n";

      if(is_object($to) && $to->language) {
        $this->subject = $lang->getMsg('mails_'.$type.'_header', $to->language);
        $this->body = $lang->getMsg('mails_'.$type.'_body', $to->language).$lang->getMsg('mails_goodbye', $to->language);
      }
      else {
        $this->subject = $lang->getMsg('mails_'.$type.'_header');
        $this->body = $lang->getMsg('mails_'.$type.'_body').$lang->getMsg('mails_goodbye');
      }

      // replace variables
      
      if($type == "registered") {
        $this->replaceVar('USERNAME', $obj->name);
        $this->replaceVar('PASSWORD', $obj2);
      }
      
      if($type == "lostpassword") {
        $this->replaceVar('PASSWORD', $obj);
      }
      
      if($type == "found_pool_refused") {
        $this->replaceVar('POOLDESC', $obj->description);
        $this->replaceVar('POOLNAME', $obj->name);
        $this->replaceVar('POOLAREA', $obj->area);
      }
      
      if($type == "found_pool_admin") {
        $this->replaceVar('POOLDESC', $obj->description);
        $this->replaceVar('POOLNAME', $obj->name);
        $this->replaceVar('POOLAREA', $obj->area);
      }

      if($type == "found_pool_founder") {
        $this->replaceVar('POOLNAME', $obj->name);
      }
      
      if($type == "found_pool_accepted") {
        $this->replaceVar('POOLDESC', $obj->description);
        $this->replaceVar('POOLNAME', $obj->name);
        $this->replaceVar('POOLAREA', $obj->area);
      }
      
      if($type == "pool_deleted") {
        $this->replaceVar('POOLDESC', $obj->description);
        $this->replaceVar('POOLNAME', $obj->name);
        $this->replaceVar('POOLAREA', $obj->area);
      }
      
      if($type == "give_order") {
        $this->replaceVar('RESNAME', $obj->name);
        $this->replaceVar('USERNAME', $obj2->name);
        $this->replaceVar('USEREMAIL', $obj2->email);
        $this->replaceVar('USERPHONE', $obj2->phone);
        $this->replaceVar('USERHOUSE', $obj2->house);
        $this->replaceVar('USERSTREET', $obj2->street);
        $this->replaceVar('USERCOUNTRY', $obj2->country);
        $this->replaceVar('USERCITY', $obj2->city);
        $this->replaceVar('USERPLZ', $obj2->plz);
        $this->replaceVar('USERCOMMENT', $obj3);
        $from = "From: ".$obj2->name." <".$obj2->email.">\r\n";
      }
      
      if($type == "borrow_order") {
        $this->replaceVar('RESNAME', $obj->name);
        $this->replaceVar('USERNAME', $obj2->name);
        $this->replaceVar('USEREMAIL', $obj2->email);
        $this->replaceVar('USERPHONE', $obj2->phone);
        $this->replaceVar('USERHOUSE', $obj2->house);
        $this->replaceVar('USERSTREET', $obj2->street);
        $this->replaceVar('USERCOUNTRY', $obj2->country);
        $this->replaceVar('USERCITY', $obj2->city);
        $this->replaceVar('USERPLZ', $obj2->plz);
        $this->replaceVar('USERCOMMENT', $obj3);
        $from = "From: ".$obj2->name." <".$obj2->email.">\r\n";
      }
      
      if($type == "nogood_order") {
        $this->replaceVar('RESNAME', $obj->name);
        $this->replaceVar('USERNAME', $obj2->name);
        $this->replaceVar('USEREMAIL', $obj2->email);
        $this->replaceVar('USERPHONE', $obj2->phone);
        $this->replaceVar('USERHOUSE', $obj2->house);
        $this->replaceVar('USERSTREET', $obj2->street);
        $this->replaceVar('USERCOUNTRY', $obj2->country);
        $this->replaceVar('USERCITY', $obj2->city);
        $this->replaceVar('USERPLZ', $obj2->plz);
        $this->replaceVar('USERCOMMENT', $obj3);
        $from = "From: ".$obj2->name." <".$obj2->email.">\r\n";
      }
      
      if($type == "user_accepted") {
        $this->replaceVar('POOLNAME', $obj->name);
      }
      
      if($type == "user_refused") {
        $this->replaceVar('POOLNAME', $obj->name);
      }

      if($type == "new_member") {
        $this->replaceVar('POOLNAME', $obj->name);
        $this->replaceVar('USERNAME', $obj2->name);
        $this->replaceVar('USEREMAIL', $obj2->email);
        $this->replaceVar('USERCOMMENT', $obj3);
      }

      if($type == "give_accepted") {
        $this->replaceVar('RESNAME', $obj->name);
        $this->replaceVar('USERNAME', $obj2->name);
        $this->replaceVar('USEREMAIL', $obj2->email);
        $this->replaceVar('USERPHONE', $obj2->phone);
        $this->replaceVar('USERHOUSE', $obj2->house);
        $this->replaceVar('USERSTREET', $obj2->street);
        $this->replaceVar('USERCOUNTRY', $obj2->country);
        $this->replaceVar('USERCITY', $obj2->city);
        $this->replaceVar('USERPLZ', $obj2->plz);
        $from = "From: ".$obj2->name." <".$obj2->email.">\r\n";
      }

      if($type == "nogood_accepted") {
        $this->replaceVar('RESNAME', $obj->name);
        $this->replaceVar('USERNAME', $obj2->name);
        $this->replaceVar('USEREMAIL', $obj2->email);
        $this->replaceVar('USERPHONE', $obj2->phone);
        $this->replaceVar('USERHOUSE', $obj2->house);
        $this->replaceVar('USERSTREET', $obj2->street);
        $this->replaceVar('USERCOUNTRY', $obj2->country);
        $this->replaceVar('USERCITY', $obj2->city);
        $this->replaceVar('USERPLZ', $obj2->plz);
        $from = "From: ".$obj2->name." <".$obj2->email.">\r\n";
      }
	  
      if($type == "borrow_accepted") {
        $this->replaceVar('RESNAME', $obj->name);
        $this->replaceVar('USERNAME', $obj2->name);
        $this->replaceVar('USEREMAIL', $obj2->email);
        $this->replaceVar('USERPHONE', $obj2->phone);
        $this->replaceVar('USERHOUSE', $obj2->house);
        $this->replaceVar('USERSTREET', $obj2->street);
        $this->replaceVar('USERCOUNTRY', $obj2->country);
        $this->replaceVar('USERCITY', $obj2->city);
        $this->replaceVar('USERPLZ', $obj2->plz);
        $from = "From: ".$obj2->name." <".$obj2->email.">\r\n";
      }

      if($type == "refused") {
        $this->replaceVar('RESNAME', $obj->name);
        $from = "From: ".$obj2->name." <".$obj2->email.">\r\n";
      }
	  
      if($type == "kick_member") {
        $this->replaceVar('POOLNAME', $obj->name);
      }
	  
      if($type == "new_admin") {
        $this->replaceVar('POOLNAME', $obj->name);
      }
	  
      if($type == "invite") {
        $this->replaceVar('INVITERNAME', $obj->name);
        $this->replaceVar('INVITERMAIL', $obj->email);
        $this->replaceVar('ADDMSG', $obj2.'
        
');
      }
	  
      if($type == "new_pm") {
        $this->replaceVar('SENDERNAME', $obj->name);
      }
	  
      mb_internal_encoding('UTF-8');

      $subject = mb_encode_mimeheader($this->subject,"UTF-8","Q");
      $body = $this->body;

      $headers  = "Reply-To: whopools.net <".$admin_email.">\r\n";
      $headers .= $from;
      $headers .= "MIME-Version: 1.0\r\n";
      $headers .= "Content-type: text/plain; charset=utf-8\r\n";
      $headers .= "X-Mailer: php";

      if(is_object($to)) 
        $recipient = $to->email;
      else
        $recipient = $to;
        
      mail($recipient, $subject, $body, $headers);
    }
    
}
?>