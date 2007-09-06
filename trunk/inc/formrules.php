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

function parseHttpAcceptLanguage($str=NULL) { 
  // getting http instruction if not provided 
  $str=$str?$str:$_SERVER['HTTP_ACCEPT_LANGUAGE']; 
  // exploding accepted languages 
  $langs=explode(',',$str);
  // creating output list 
  $accepted=array(); 
  foreach ($langs as $lang) { 
    // parsing language preference instructions 
    // 2_digit_code[-longer_code][;q=coefficient] 
    ereg('([a-z]{1,2})(-([a-z0-9]+))?(;q=([0-9\.]+))?',$lang,$found); 
    // 2 digit lang code 
    $code=$found[1]; 
    // lang code complement 
    $morecode=$found[3]; 
    // full lang code 
    $fullcode=$morecode?$code.'-'.$morecode:$code; 
    // coefficient 
    $coef=sprintf('%3.1f',$found[5]?$found[5]:'1'); 
    // for sorting by coefficient 
    $key=$coef.'-'.$code; 
    // adding 
    $accepted[]=array('code'=>$code,'coef'=>$coef,'morecode'=>$morecode,'fullcode'=>$fullcode); 
  } 
  // sorting the list by coefficient desc 
  krsort($accepted); return $accepted;
}

function secureHtml($text) {
  if(stripos($text, "<script") === false)
    return true;
    
  else return false;
}

function convertNewsSubmits($text){
   //DIE UMLAUTE WERDEN KONVERTIERT  /////
   $text = nl2br($text);
   $pattern1="/ä/";
   $replace1="&#228;";
   $text=preg_replace($pattern1,$replace1, $text);
   $pattern2="/ö/";
   $replace2="&#246;";
   $text=preg_replace($pattern2,$replace2, $text);
   $pattern3="/ü/";
   $replace3="&#252;";
   $text=preg_replace($pattern3,$replace3, $text);
   $pattern1a="/Ä/";
   $replace1a="&#196;";
   $text=preg_replace($pattern1a,$replace1a, $text);
   $pattern2a="/Ö/";
   $replace2a="&#214;";
   $text=preg_replace($pattern2a,$replace2a, $text);
   $pattern3a="/Ü/";
   $replace3a="&#220;";
   $text=preg_replace($pattern3a,$replace3a, $text);
   $pattern4="/ß/";
   $replace4="&#xDF;";
   $text=preg_replace($pattern4,$replace4, $text);
   return $text;
}

function unhtmlentities($text) {
  $text = html_entity_decode($text);
  $text = str_replace('<i>', '"', $text);
  $text = str_replace('</i>', '"', $text);
  $text = str_replace('<P>', '

', $text);
  $text = str_replace('<I>', '', $text);
  $text = str_replace('</I>', '', $text);
  
  return $text;
}

// login has to be correct
function loginCorrect($login, $password) {
  if($login != "") {
    $user = new user;
    $user->name = $login;
    if($password != "") {
      $user->password = crypt($password, 'dl');
    }
  }
  if($user->find())
    return true;
  else return false;
}

// passwordchange: is old password valid
function proovePassword($password) {
  $params = services::getService('pageParams');
  
  return loginCorrect($params->getParam('login'), $password);
}

// username has to be unique
function usernameUnique($username) {
  $check_user = new user;
  $check_user->name = $username;
  if($check_user->find())
    return false;
  else return true;
}

function emailUnique($email) {
  $check_user = new user;
  $check_user->email = $email;
  if($check_user->find())
    return false;
  else return true;
}

function passwordEase($pass) {
    
    $lc_pass = strtolower($pass);
    // also check password with numbers or punctuation subbed for letters
    $denum_pass = strtr($lc_pass,'5301!','seoll');

    // count how many lowercase, uppercase, and digits are in the password 
    $uc = 0; $lc = 0; $num = 0; $other = 0;
    for ($i = 0, $j = strlen($pass); $i < $j; $i++) {
        $c = substr($pass,$i,1);
        if (preg_match('/^[[:upper:]]$/',$c)) {
            $uc++;
        } elseif (preg_match('/^[[:lower:]]$/',$c)) {
            $lc++;
        } elseif (preg_match('/^[[:digit:]]$/',$c)) {
            $num++;
        } else {
            $other++;
        }
    }

    // the password must have more than two characters of at least 
    // two different kinds 
    $max = $j - 2;
    if ($uc > $max) {
        return false;
    }
    if ($lc > $max) {
        return false;
    }
    if ($num > $max) {
        return false;
    }
    if ($other > $max) {
        return false;
    }
    return true;
}

function passwordCommon($pass) {
    $word_file = './inc/wordlist.list';
    // the password must not contain a dictionary word 
    $lc_pass = strtolower($pass);
    // also check password with numbers or punctuation subbed for letters
    $denum_pass = strtr($lc_pass,'5301!','seoll');

    if (is_readable($word_file)) {
        if ($fh = fopen($word_file,'r')) {
            $found = false;
            while (! ($found || feof($fh))) {
                $word = trim(strtolower(fgets($fh,1024)));
                if (strlen($word) > 5 && (preg_match("/$word/",$lc_pass) ||
                    preg_match("/$word/",$denum_pass))) {
                    $found = true;
                }
            }
            fclose($fh);
            if ($found) {
                return false;
            }
        }
    }
    return true;
}


?>