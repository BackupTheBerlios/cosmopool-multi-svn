<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>{$html_title}</title>
<link rel="stylesheet" type="text/css" href="./inc/style.css">
{if $javascript}<script src="./inc/form_resdata.js" type="text/javascript"></script>{/if}
</head>
<body class="page"{if $javascript} onload="init({$javascriptarray})"{/if}>
  <div id="header">
    <img src="./images/logo.png" id="logo_left" usemap="logolink">
    <map name="logolink">
      <area shape="rect" coords="248,35,365,50" href="http://www.cosmopool.net/">
    </map>
    <div  id="lang_menutop">
        {lang->getMsg p1='common_language'}: 
    {foreach from=$other_lang item="lang"}<a href="./index.php?lang={$lang}{$act_get}"><img 
        class="lang_menutop2" src="./images/lang_menu_{$lang}_b.png"></a>{/foreach}
    </div>
    {if $is_logged_in}
    {if $act_lang == "de"}
    <a href="./index.php?page=help"><img src="./images/header-links-de-1.png" class="helplink"></a>
    <a href="./index.php?page=logout"><img src="./images/header-links-de-2.png" class="logoutlink"></a>
    {/if}{if $act_lang == "en"}
    <a href="./index.php?page=help"><img src="./images/header-links-en-1.png" class="helplink"></a>
    <a href="./index.php?page=logout"><img src="./images/header-links-en-2.png" class="logoutlink"></a>
    {/if}{if $act_lang == "es"}
    <a href="./index.php?page=help"><img src="./images/header-links-en-1.png" class="helplink"></a>
    <a href="./index.php?page=logout"><img src="./images/header-links-en-2.png" class="logoutlink"></a>
    {/if}
    <map name="headerlinks">
      <area shape="rect" coords="126,35,183,50" href="./index.php?page=logout">
      <area shape="rect" coords="75,35,125,50" href="./index.php?page=help">
    </map>
    {/if}
  </div>

  <div id="content">
  {foreach from=$msg item="msg"}
  <span class="msgtop">
  <font color="#000000">&nbsp;</font> {$msg} <font color="#000000">&nbsp;</font>
  </span>
  {/foreach}
  <div id="headline">{$header}</div>

