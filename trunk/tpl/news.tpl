<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>{lang->getMsg p1='html_title'}</title>
<link rel="stylesheet" type="text/css" href="./inc/style.css">
{if $javascript}<script src="./inc/form_resdata.js" type="text/javascript"></script>{/if}
<script src="./inc/lang_menu.js" type="text/javascript"></script>
</head>
<body class="page"{if $javascript} onload="init({$javascript})"{/if}>
  <div id="header">
    <img src="./images/logo.png" id="logo_left" usemap="logolink">
    <map name="logolink">
      <area shape="rect" coords="248,35,365,50" href="http://www.cosmopool.net/">
    </map>
        <div  id="lang_menutop">
        language: 
    </div>
    {foreach from=$other_lang item="lang"} 
        <a href="./index.php?lang={$lang}{$act_get}">
        <img  id="lang_menutop2" src="./images/lang_menu_{$lang}_b.png"></a> 
    {/foreach}

  </div>


  <div id="content">
  <div id="headline">{lang->getMsg p1='news_header'}: {$shownews.name}</div>
  <div id="content2">
      <b>{$shownews.abstract}</b><br><br>
      <p class="standard">{$shownews.text}</p>
  </div></div>
  <div id="linklist">
        <a href="index.php?page=home"><< {lang->getMsg p1='homepage_backlink'}</a>
    </div>
  <!-- 4stats Tracker Code // begin -->
<script type="text/javascript" language="javascript" src="http://4stats.de/de/counter?id=21841&cntr=hide"></script><noscript><a href="http://www.4stats.de/" target="_blank"><img src="http://4stats.de/de/stats?id=21841&cntr=hide" border="0" alt="4stats Webseiten Statistik + Counter" /></a></noscript>
<!-- 4stats Tracker Code // end -->
  </body>
</html>
