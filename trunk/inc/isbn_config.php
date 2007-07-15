<?php
/***************************************************************************
*                            isbnconfig.inc
*                            -------------------
*   begin                : 2003/08/31
*   copyright            : (C) 2003 Mike Benham
*                        : Licensed under the GNU GPL.
*                        : For full terms see the file COPYING.
*   email                : info@communitybooks.org
*
*   $Id: isbn_config.inc,v 1.6 2003/09/24 05:35:37 moxie Exp $
*
*
***************************************************************************/

define("HOST", "xml-eu.amazon.com");
define("LOCALE", "de");

define("BASEURL", "GET /onca/xml3?t=dlp&dev-t=D3DKWA7CM9U0TG&mode=books&locale=" . LOCALE . "&type=heavy&page=1&f=xml&PowerSearch=asin:");
define("PORT", "80");
define("AUTHOR", "AUTHOR");
define("TITLE", "PRODUCTNAME");
define("SECTION", "BROWSENAME");
define("REVIEW", "COMMENT");
define("RATING", "RATING");
define("DESC", "PRODUCTDESCRIPTION");

// See http://www.isbn.org/standards/home/isbn/international/html/usm7.htm#chap7p5
function ean2isbn($ean) {
  $ean    = substr("$ean", 3, -1); 
  $digits = preg_split('//', $ean, -1, PREG_SPLIT_NO_EMPTY);    
  $sum    =0;
  $count  =0;

  foreach($digits as $digits) {
    $sum += ($digits * (10-$count));
    $count++;
  }

  $check = 11 - ($sum % 11);

  if     ($check==11) $check=0;
  elseif ($check==10) $check='X';

  $isbn = $ean . $check;
  return $isbn;
}

function isbnStripSeparators($isbn) {
  $temp = preg_replace("/\s?-?/", "", $isbn); 
  return preg_replace("/x/", "X", $temp);
}

function isEan($isbn) {
  return preg_match('/^978[0-9]{10}$/', $isbn);
}

function is_isbn($isbn) {
  return preg_match('/^[0-9]{9}[0-9x]$/i', $isbn);
}

function detectIsbnError($isbn) {
  $digits = preg_split('//', $isbn, -1, PREG_SPLIT_NO_EMPTY);

  $sum = 0;
  for ($i=0;$i<9;$i++) {
    $sum += ($digits[$i] * ($i+1));
  }

  if ($sum % 11 == 10) return $digits[9] != 'X';
  else                 return $digits[9] != $sum % 11;
}

function checkIsbn($isbn) {
  global $lang;
  if (isEmpty($isbn)) {
    return $lang['please_specify_ISBN'];
  }
  if (!isIsbn($isbn)) {
    return $isbn.' '.$lang['not_EAN_not_ISBN'];
  }
  if (isIsbn($isbn) and detectIsbnError($isbn)) {
    return $isbn.' '.$lang['ISBN_with_error'];
  }

  return NULL;
}

function cleanIsbn($isbn) {
  if (isEan($isbn))
    $isbn = ean2isbn($isbn);

  return isbnStripSeparators($isbn);
}

class IsbnParser {
  var $data;

  var $authorlast, $authorfirst;
  var $title, $section;
  var $review, $rating;
  var $isbn, $acceptReview;
  var $description;

  function IsbnParser() {
    $this->acceptReview = false;
    $this->rating       = 0;
  }

  function startHandler($parser, $sTag, $arAttr) {}

  function dataHandler($parser, $sTag) {
    $this->data .= $sTag;
  }

  function handleAuthor($data) {
    if ($this->authorlast == "") {
      $arr               = explode(" ", $data);
      $this->authorlast  = $arr[count($arr)-1];
      $this->authorfirst = join(" ", array_slice($arr, 0, count($arr)-1));
   }
  }

  function handleTitle($data) {
    if ($this->title == "") {
      $this->title = $data;
    }
  }

  function handleSection($data) {
    if ($this->section == "") {
      if ($this->bs->isValid($data))
	$this->section = $data;
    }
  }

  function handleReview($data) {
    global $lang;
    if ($this->acceptReview) {
      $this->review       = $lang['From_Amazon'].":\n\n\"" . $data . "\"";
      $this->acceptReview = false;
    }
  }

  function handleDescription($data) {
    global $lang;
    $this->description = $lang['From_Amazon'].":\n" . $data;
  }

  function handleRating($data) {
    if ($data > $this->rating) {
      $this->rating       = $data;
      $this->acceptReview = true;
    }
  }

  function endHandler($parser, $sTag) {
    $this->data = trim($this->data);

    if      ($sTag == AUTHOR)  $this->handleAuthor($this->data);
    else if ($sTag == DESC)    $this->handleDescription($this->data);
    else if ($sTag == TITLE)   $this->handleTitle($this->data);
    else if ($sTag == SECTION) $this->handleSection($this->data);
    else if ($sTag == REVIEW)  $this->handleReview($this->data);
    else if ($sTag == RATING)  $this->handleRating($this->data);

    $this->data = "";
  }
  
  function parse($fp) {
    $parser = xml_parser_create();

    xml_set_object($parser, $this);
    xml_set_element_handler($parser, 'startHandler', 'endHandler');
    xml_set_character_data_handler($parser, 'dataHandler');

    while ($data = fread($fp, 2048)) {
      if (!xml_parse($parser, $data)) {
	     fclose($fp);
        return false;
      }
    }

    fclose($fp);
    xml_parser_free($parser);
    return true;
  }
}

class IsbnLookup {

  var $parser;

  function IsbnLookup() {
    $this->parser = new IsbnParser();
  }

  function sendRequest($isbn) {
    $url = BASEURL . $isbn . " HTTP/1.0 \r\n\r\n";    
    $fp  = fsockopen(HOST, PORT, $errno, $errstr, 20);
    fputs($fp, $url);
    socket_set_blocking($fp, true);

    return $fp;
  }

  function checkResponse($fp) {
    $sLine = fgets($fp, 1024);
    $iCode = preg_replace("/.*(\d\d\d).*/i" , "\\1" , $sLine);    

    return $iCode == 200;
  }

  function skipHeader($fp) {
    while (!feof($fp)) {
      $sLine = fgets($fp , 1024);
      echo $sLine;
      if (strlen($sLine) < 3) break;
    }
  }

  function lookup($isbn) {
    $fp = $this->sendRequest($isbn);

    if ($this->checkResponse($fp)) {
      $this->skipHeader($fp);
      $this->parser->parse($fp);
    }

    return $this->parser;
  }
}

?>