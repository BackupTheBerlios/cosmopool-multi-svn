<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<meta name="description" content="{lang->getMsg p1='html_description'}">
<meta name="keywords" content="{lang->getMsg p1='html_keywords'}">
<title>{lang->getMsg p1='html_title'} - {lang->getMsg p1='html_title-2'}</title>
<link rel="stylesheet" type="text/css" href="./inc/style.css">
{if $javascript}<script src="./inc/form_resdata.js" type="text/javascript"></script>{/if}
<script src="./inc/lang_menu.js" type="text/javascript"></script>
</head>
<body class="page"{if $javascript} onload="init({$javascript})"{/if}>
<div id="space"> </div>
<div id="page">
  <div id="header">
    <img src="./images/logo.png" id="logo_left" usemap="logolink">
    <map name="logolink">
      <area shape="rect" coords="248,35,365,50" href="http://www.cosmopool.net/">
    </map>
    <div  id="lang_menutop">
        {lang->getMsg p1='common_language'}:&nbsp; 
    {foreach from=$other_lang item="lang"}<a href="./index.php?lang={$lang}{$act_get}"><img 
        class="lang_menutop2" src="./images/lang_menu_{$lang}_b.png"></a> {/foreach}
    </div>
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

{if $lostpassword}
<div id="leftcolumn"><br>
  <div id="linklist">
        <a class="navi" href="index.php?page=home">{lang->getMsg p1='homepage_backlink'}</a>
  </div>
  </div>
{else}
		<div id="login">
        {$login_form}
        <div class="logintext"><br><a href=./index.php?page=home&lostpassword=true>{lang->getMsg p1='home_lostpassword_link'}</a><br><br></div>
          <div class="logintext2">{lang->getMsg p1='home_login_registertext-1'} <a href="index.php?page=register">{lang->getMsg p1='home_login_registertext-2'}</a>.</div>
</div><script type="text/javascript">
		<!--
		document.loginform.login_login.focus();
		//-->
		</script>
{/if}


  <div id="content">
  {foreach from=$msg item="msg"}
  <span class="msgtop">
  <font color="#000000">&nbsp;</font> {$msg} <font color="#000000">&nbsp;</font>
  </span>
  {/foreach}
  {if $lostpassword}
  <div id="headline">{lang->getMsg p1='home_lostpasswordheader'}</div>
  {else}
  <div id="headline">{lang->getMsg p1='home_header'}</div>
  {/if}
  <div id="content2">
  {$newsform}

{if $lostpassword}

{lang->getMsg p1='home_lostpassword_text'}<br><br>
{$pwform}
{else}

        {lang->getMsg p1='home_welcome-1'}<br>
        <a href="./index.php?page=static&pageid=about">{lang->getMsg p1='home_links_1'} &raquo;</a> 
        <br>{lang->getMsg p1='home_welcome-2'}<br><br>
        {lang->getMsg p1='home_ng_res_count-1'}
        <font class="msg">{$res_count}</font>
        {lang->getMsg p1='home_ng_res_count-3'}.
<!--        <table align="center"><tr>
                   <td width=30 align=center><img src="./images/home-links-2.png"></td>
                   <td width=160 align=center><a href="http://www.whopools.net/software/" target="_blank">cosmopool-multi</a><br>
                       {lang->getMsg p1='home_links_2'}</td>
                   <td width=30 align=center><img src="./images/home-links-3.png"></td>
                   <td width=210 align=center><a href="http://wws.dynalias.org/" target="_blank">cosmopool-global wiki</a><br>
                       {lang->getMsg p1='home_links_3'}</td></tr></table>-->
                       
{/if}
</div>
</div>
    <div id="footer"> <a href="./index.php?page=static&pageid=about">{lang->getMsg p1='common_bottom_about'}</a> |&nbsp; 
    <a href="http://www.whopools.net/blog/" target="_blank">{lang->getMsg p1='common_bottom_blog'}</a> |&nbsp;
    <a href="http://www.whopools.net/software/" target="_blank">{lang->getMsg p1='common_bottom_developers'}</a> |&nbsp;
    <a href="http://www.cosmopool.net" target="_blank">{lang->getMsg p1='common_bottom_supersite'}</a>    |&nbsp; 
    <a href="./index.php?page=static&pageid=contact">{lang->getMsg p1='common_bottom_contact'}</a> </div>

<!-- 4stats Tracker Code // begin -->
<script type="text/javascript" language="javascript" src="http://4stats.de/de/counter?id=21841&cntr=hide"></script><noscript><a href="http://www.4stats.de/" target="_blank"><img src="http://4stats.de/de/stats?id=21841&cntr=hide" border="0" alt="4stats Webseiten Statistik + Counter" /></a></noscript>
<!-- 4stats Tracker Code // end -->
</div>
</body>
</html>


