<?php /* Smarty version 2.6.9, created on 2007-07-28 21:21:37
         compiled from news.tpl */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'html_title'), $this);?>
</title>
<link rel="stylesheet" type="text/css" href="./inc/style.css">
<?php if ($this->_tpl_vars['javascript']): ?><script src="./inc/form_resdata.js" type="text/javascript"></script><?php endif; ?>
<script src="./inc/lang_menu.js" type="text/javascript"></script>
</head>
<body class="page"<?php if ($this->_tpl_vars['javascript']): ?> onload="init(<?php echo $this->_tpl_vars['javascript']; ?>
)"<?php endif; ?>>
  <div id="header">
    <img src="./images/logo.png" id="logo_left" usemap="logolink">
    <map name="logolink">
      <area shape="rect" coords="248,35,365,50" href="http://www.cosmopool.net/">
    </map>
        <div  id="lang_menutop">
        language: 
    </div>
    <?php $_from = $this->_tpl_vars['other_lang']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['lang']):
?> 
        <a href="./index.php?lang=<?php echo $this->_tpl_vars['lang'];  echo $this->_tpl_vars['act_get']; ?>
">
        <img  id="lang_menutop2" src="./images/lang_menu_<?php echo $this->_tpl_vars['lang']; ?>
_b.png"></a> 
    <?php endforeach; endif; unset($_from); ?>

  </div>


  <div id="content">
  <div id="headline"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'news_header'), $this);?>
: <?php echo $this->_tpl_vars['shownews']['name']; ?>
</div>
  <div id="content2">
      <b><?php echo $this->_tpl_vars['shownews']['abstract']; ?>
</b><br><br>
      <p class="standard"><?php echo $this->_tpl_vars['shownews']['text']; ?>
</p>
  </div></div>
  <div id="linklist">
        <a href="index.php?page=home"><< <?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'homepage_backlink'), $this);?>
</a>
    </div>
  <!-- 4stats Tracker Code // begin -->
<script type="text/javascript" language="javascript" src="http://4stats.de/de/counter?id=21841&cntr=hide"></script><noscript><a href="http://www.4stats.de/" target="_blank"><img src="http://4stats.de/de/stats?id=21841&cntr=hide" border="0" alt="4stats Webseiten Statistik + Counter" /></a></noscript>
<!-- 4stats Tracker Code // end -->
  </body>
</html>