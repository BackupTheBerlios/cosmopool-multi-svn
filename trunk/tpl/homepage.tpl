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
    {if $is_logged_in}
    {if $act_lang == "de"}
    <a href="./index.php?page=help"><img src="./images/header-links-de-1.png" class="helplink"></a>
    <a href="./index.php?page=logout"><img src="./images/header-links-de-2.png" class="logoutlink"></a>
    {/if}{if $act_lang == "en"}
    <a href="./index.php?page=help"><img src="./images/header-links-en-1.png" class="helplink"></a>
    <a href="./index.php?page=logout"><img src="./images/header-links-en-2.png" class="logoutlink"></a>
    {/if}
    <map name="headerlinks">
      <area shape="rect" coords="126,35,183,50" href="./index.php?page=logout">
      <area shape="rect" coords="75,35,125,50" href="./index.php?page=help">
    </map>
    {else}
  {if $lostpassword}
    <div id="header_links_right">
        
    </div>
  {else}
    {/if}{/if}
  </div>

  {foreach from=$msg item="msg"}
  <div class="msgtop">
  <font color="#000000">[</font> {$msg} <font color="#000000">]</font>
  </div>
  {/foreach}

  {if $lostpassword}
  <div id="headline">{lang->getMsg p1='home_lostpasswordheader'}</div>
  {else}
  <div id="headline">{lang->getMsg p1='home_header'}</div>
  {/if}

  <div id="content">
  {$newsform}

{if $lostpassword}

{lang->getMsg p1='home_lostpassword_text'}<br><br>
{$pwform}
</div>
  <div id="linklist">
    <div id="linklist_links">
        <a href="index.php?page=home"><< {lang->getMsg p1='homepage_backlink'}</a>
    </div>
  </div>
{else}

        {lang->getMsg p1='home_welcome-1'}<br><br><br>
        <table align="center"><tr>
                   <td width=30 align=center><img src="./images/home-links-2.png"></td>
                   <td width=160 align=center><a href="http://www.whopools.net/software/">cosmopool-multi</a><br>
                       {lang->getMsg p1='home_links_2'}</td>
                   <td width=30 align=center><img src="./images/home-links-3.png"></td>
                   <td width=210 align=center><a href="http://wws.dynalias.org/">cosmopool-global wiki</a><br>
                       {lang->getMsg p1='home_links_3'}</td></tr></table>
        <p class="headline2">News</p>
        <div class="news">
        <p class="standard">
{foreach from=$shownews item="news"}        
        {$news.date}: <a href="./index.php?page=news&news_id={$news.id}">{$news.name}</a><br>
{/foreach}        
        </p>
        </div></div>
		<div id="login">
        <div id="login_headline">
          {lang->getMsg p1='home_login_header'}
        </div>
        <p>
          {lang->getMsg p1='home_login_registertext-1'} <a href="index.php?page=userdata">{lang->getMsg p1='home_login_registertext-2'}</a>.
        </p>
        {$login_form}
{/if}
</div><script type="text/javascript">
		<!--
		document.loginform.login_login.focus();
		//-->
		</script>
<!-- 4stats Tracker Code // begin -->
<script type="text/javascript" language="javascript" src="http://4stats.de/de/counter?id=21841&cntr=hide"></script><noscript><a href="http://www.4stats.de/" target="_blank"><img src="http://4stats.de/de/stats?id=21841&cntr=hide" border="0" alt="4stats Webseiten Statistik + Counter" /></a></noscript>
<!-- 4stats Tracker Code // end -->
</body>
</html>


