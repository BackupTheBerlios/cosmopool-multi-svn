<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>{lang->getMsg p1='html_title'}</title>
<link rel="stylesheet" type="text/css" href="./inc/style.css">
{if $javascript}<script src="./inc/form_resdata.js" type="text/javascript"></script>{/if}
</head>
<body class="page"{if $javascript} onload="init({$javascript})"{/if}>
  <div id="lang_menu">
  {lang->getMsg p1='language_changer'}
  </div>
  <ul id="lang_menu_top"> 
    <li><a href="./index.php?lang={$act_lang}{$act_get}"><img src="./images/lang_menu_{$act_lang}_b.png"></a><ul>
    {foreach from=$other_lang item="lang"} 
        <li><a href="./index.php?lang={$lang}{$act_get}"><img src="./images/lang_menu_{$lang}_w.png"></a></li> 
    {/foreach}
      </ul> 
    </li> 
  </ul>
  <div id="header">
    <img src="./images/logo.png" id="logo_left">
    <p id="header_links_right">
        <a href="index.php?page=home"><< {lang->getMsg p1='software_backlink'}</a>
    </p>
  </div>

  <p id="headline">{lang->getMsg p1='software_header'}</p>

  <div id="content">
      <p class="standard">{lang->getMsg p1='software_intro'}</p>
      <p class="headline2">{lang->getMsg p1='software_download_header'}</p>
      <p class="standard">{lang->getMsg p1='software_download_text-1'}</p>
      <p class="standard">{lang->getMsg p1='software_download_text-2'}</p>
      <p class="standard">{lang->getMsg p1='software_download_text-3'}</p>
      <p class="standard">{lang->getMsg p1='software_download_text-4'}</p>
      <p class="headline2">{lang->getMsg p1='software_install_header'}</p>
      <p class="standard">{lang->getMsg p1='software_install_text-1'}</p>
      <ul class=software>
      <li class="standard">{lang->getMsg p1='software_install_text-2'}</li>
      <li class="standard">{lang->getMsg p1='software_install_text-3'}</li>
      <li class="standard">{lang->getMsg p1='software_install_text-4'}</li>
      <li class="standard">{lang->getMsg p1='software_install_text-5'}</li>
      <li class="standard">{lang->getMsg p1='software_install_text-6'}</li>
      <li class="standard">{lang->getMsg p1='software_install_text-7'}</li>
      </ul>
  </div>
  </body>
</html>
