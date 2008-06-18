<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<meta name="description" content="{lang->getMsg p1='html_description'}">
<meta name="keywords" content="{lang->getMsg p1='html_keywords'}">
<title>{$html_title} - {$header}</title>
<link rel="stylesheet" type="text/css" href="./inc/style.css">
{if $javascript}<script src="./inc/form_resdata.js" type="text/javascript"></script>{/if}
</head>
<body class="page"{if $javascript} onload="init({$javascriptarray})"{/if}>
<div id="space"> </div>
<div id="page">
  <div id="header">
    <div  id="lang_menutop">
        {lang->getMsg p1='common_language'}:&nbsp; 
    {foreach from=$other_lang item="lang"}<a href="./index.php?lang={$lang}{$act_get}"><img 
        class="lang_menutop2" src="./images/lang_menu_{$lang}_b.png"></a> {/foreach}
    {if $is_logged_in}
    {if $act_lang == "de"}
    <a href="./index.php?page=logout"><img src="./images/header-links-de-2.png" class="logoutlink"></a>
    <a href="./index.php?page=help"><img src="./images/header-links-de-1.png" class="helplink"></a>
    {/if}{if $act_lang == "en"}
    <a href="./index.php?page=logout"><img src="./images/header-links-en-2.png" class="logoutlink"></a>
    <a href="./index.php?page=help"><img src="./images/header-links-en-1.png" class="helplink"></a>
    {/if}{if $act_lang == "es"}<a href="./index.php?page=logout"><img src="./images/header-links-en-2.png" class="logoutlink"></a><a href="./index.php?page=help"><img src="./images/header-links-en-1.png" class="helplink"></a>{/if}
    {/if}</div>
    <a href="./index.php"><img src="./images/logo.png" id="logo_left"></a>
    </div>

<div id="leftcolumn">
  <br>{$searchform}
  {if $footerlinks}
  <div id="linklist">
    <div class="linklist_links">
      <a class="navi" href="index.php?page=userdata"> {lang->getMsg p1='mysite_links_userdata_name'}</a>
    </div>
    <div class="linklist_links">
      <a class="navi" href="index.php?page=resmanager">{lang->getMsg p1='mysite_res_header'}</a>
    </div>
{if $borrowed_res}
    <div class="linklist_links2">
    <a class="navi" href="./index.php?page=resmanager&function=borrowed"> {lang->getMsg p1='resmanager_borrowed_header'}</a>
    </div>
{/if}
    <div class="linklist_links2">
    <a class="navi" href="./index.php?page=resmanager&function=all"> {lang->getMsg p1='resmanager_all_header'}</a>
    </div>
    <div class="linklist_links2">
    <a class="navi" href="index.php?page=resdata"> {lang->getMsg p1='mysite_links_resdata_name'}</a>
    </div>
    <div class="linklist_links">
      <a class="navi" href="index.php?page=mypools"> {lang->getMsg p1='mysite_mypools_header'}</a>
    </div>
    <div class="linklist_links">
      <a class="navi" href="index.php?page=pm"> {lang->getMsg p1='common_footerlinks_pm'}</a>
    </div>
    <div class="linklist_links">
      <a class="navi" href="index.php?page=invite"> {lang->getMsg p1='common_footerlinks_invite'}</a>
    </div>
  </div>
  {else}
  <div id="linklist">
        <a class="navi" href="index.php?page=home">{lang->getMsg p1='homepage_backlink'}</a>
  </div>
  
  {/if}
  {if $todo} 
  <div id="todolist">
    <b>toDo</b><br><br>
    <div id="todolist_links">
      {if $todo.res}
      / <a href="index.php?page=resmanager">{$todo.res} {lang->getMsg p1='common_todo_request'}</a>
      {/if}
      {if $todo.user}
      {foreach from=$todo.user item="pool"}
      <br><br><b>{$pool.pool->name}</b>:<br>
		\ <a href="index.php?page=pooladmin&pool_id={$pool.pool->id}">{$pool.count} {lang->getMsg p1='common_todo_userswait'}</a>
		{/foreach}
      {/if}
      {if $todo.msgs}
      / <a href="index.php?page=pm">{$todo.msgs} {lang->getMsg p1='common_todo_msgs'}{if $todo.msgs > 1}{lang->getMsg p1='common_todo_msgs_plural'}{/if}</a>
      {/if}
    </div>
  </div>
   
  {/if}
</div>

  <div id="content">
  {foreach from=$msg item="msg"}
  <span class="msgtop">
  <font color="#000000">&nbsp;</font> {$msg} <font color="#000000">&nbsp;</font>
  </span>
  {/foreach}
  <div id="headline">{$header}</div>

