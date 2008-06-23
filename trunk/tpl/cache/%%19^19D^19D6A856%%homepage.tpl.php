<?php /* Smarty version 2.6.18, created on 2007-11-30 17:10:05
         compiled from homepage.tpl */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<meta name="description" content="<?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'html_description'), $this);?>
">
<meta name="keywords" content="<?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'html_keywords'), $this);?>
">
<title><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'html_title'), $this);?>
 - <?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'html_title-2'), $this);?>
</title>
<link rel="stylesheet" type="text/css" href="./inc/style.css">
<?php if ($this->_tpl_vars['javascript']): ?><script src="./inc/form_resdata.js" type="text/javascript"></script><?php endif; ?>
<script src="./inc/lang_menu.js" type="text/javascript"></script>
</head>
<body class="page"<?php if ($this->_tpl_vars['javascript']): ?> onload="init(<?php echo $this->_tpl_vars['javascript']; ?>
)"<?php endif; ?>>
<div id="space"> </div>
<div id="page">
  <div id="header">
    <img src="./images/logo.png" id="logo_left" usemap="logolink">
    <map name="logolink">
      <area shape="rect" coords="248,35,365,50" href="http://www.cosmopool.net/">
    </map>
    <div  id="lang_menutop">
        <?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'common_language'), $this);?>
:&nbsp; 
    <?php $_from = $this->_tpl_vars['other_lang']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['lang']):
?><a href="./index.php?lang=<?php echo $this->_tpl_vars['lang']; ?>
<?php echo $this->_tpl_vars['act_get']; ?>
"><img 
        class="lang_menutop2" src="./images/lang_menu_<?php echo $this->_tpl_vars['lang']; ?>
_b.png"></a> <?php endforeach; endif; unset($_from); ?>
    </div>
    <?php if ($this->_tpl_vars['is_logged_in']): ?>
    <?php if ($this->_tpl_vars['act_lang'] == 'de'): ?>
    <a href="./index.php?page=help"><img src="./images/header-links-de-1.png" class="helplink"></a>
    <a href="./index.php?page=logout"><img src="./images/header-links-de-2.png" class="logoutlink"></a>
    <?php endif; ?><?php if ($this->_tpl_vars['act_lang'] == 'en'): ?>
    <a href="./index.php?page=help"><img src="./images/header-links-en-1.png" class="helplink"></a>
    <a href="./index.php?page=logout"><img src="./images/header-links-en-2.png" class="logoutlink"></a>
    <?php endif; ?>
    <map name="headerlinks">
      <area shape="rect" coords="126,35,183,50" href="./index.php?page=logout">
      <area shape="rect" coords="75,35,125,50" href="./index.php?page=help">
    </map>
    <?php else: ?>
  <?php if ($this->_tpl_vars['lostpassword']): ?>
    <div id="header_links_right">
        
    </div>
  <?php else: ?>
    <?php endif; ?><?php endif; ?>
  </div>

<?php if ($this->_tpl_vars['lostpassword']): ?>
<div id="leftcolumn"><br>
  <div id="linklist">
        <a class="navi" href="index.php?page=home"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'homepage_backlink'), $this);?>
</a>
  </div>
  </div>
<?php else: ?>
		<div id="login">
        <?php echo $this->_tpl_vars['login_form']; ?>

        <div class="logintext"><br><a href=./index.php?page=home&lostpassword=true><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'home_lostpassword_link'), $this);?>
</a><br><br></div>
          <div class="logintext2"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'home_login_registertext-1'), $this);?>
 <a href="index.php?page=register"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'home_login_registertext-2'), $this);?>
</a>.</div>
</div><script type="text/javascript">
		<!--
		document.loginform.login_login.focus();
		//-->
		</script>
<?php endif; ?>


  <div id="content">
  <?php $_from = $this->_tpl_vars['msg']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['msg']):
?>
  <span class="msgtop">
  <font color="#000000">&nbsp;</font> <?php echo $this->_tpl_vars['msg']; ?>
 <font color="#000000">&nbsp;</font>
  </span>
  <?php endforeach; endif; unset($_from); ?>
  <?php if ($this->_tpl_vars['lostpassword']): ?>
  <div id="headline"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'home_lostpasswordheader'), $this);?>
</div>
  <?php else: ?>
  <div id="headline"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'home_header'), $this);?>
</div>
  <?php endif; ?>
  <div id="content2">
  <?php echo $this->_tpl_vars['newsform']; ?>


<?php if ($this->_tpl_vars['lostpassword']): ?>

<?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'home_lostpassword_text'), $this);?>
<br><br>
<?php echo $this->_tpl_vars['pwform']; ?>

<?php else: ?>

        <?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'home_welcome-1'), $this);?>
<br>
        <a href="./index.php?page=static&pageid=about"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'home_links_1'), $this);?>
 &raquo;</a> 
        <br><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'home_welcome-2'), $this);?>
<br><br>
        <?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'home_ng_res_count-1'), $this);?>

        <font class="msg"><?php echo $this->_tpl_vars['res_count']; ?>
</font>
        <?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'home_ng_res_count-3'), $this);?>
.
<!--        <table align="center"><tr>
                   <td width=30 align=center><img src="./images/home-links-2.png"></td>
                   <td width=160 align=center><a href="http://www.whopools.net/software/" target="_blank">cosmopool-multi</a><br>
                       <?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'home_links_2'), $this);?>
</td>
                   <td width=30 align=center><img src="./images/home-links-3.png"></td>
                   <td width=210 align=center><a href="http://wws.dynalias.org/" target="_blank">cosmopool-global wiki</a><br>
                       <?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'home_links_3'), $this);?>
</td></tr></table>-->
                       
<?php endif; ?>
</div>
</div>
    <div id="footer"> <a href="./index.php?page=static&pageid=about"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'common_bottom_about'), $this);?>
</a> |&nbsp; 
    <a href="http://www.whopools.net/blog/" target="_blank"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'common_bottom_blog'), $this);?>
</a> |&nbsp;
    <a href="http://www.whopools.net/software/" target="_blank"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'common_bottom_developers'), $this);?>
</a> |&nbsp;
    <a href="http://www.cosmopool.net" target="_blank"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'common_bottom_supersite'), $this);?>
</a>    |&nbsp; 
    <a href="./index.php?page=static&pageid=contact"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'common_bottom_contact'), $this);?>
</a> </div>

<!-- 4stats Tracker Code // begin -->
<script type="text/javascript" language="javascript" src="http://4stats.de/de/counter?id=21841&cntr=hide"></script><noscript><a href="http://www.4stats.de/" target="_blank"><img src="http://4stats.de/de/stats?id=21841&cntr=hide" border="0" alt="4stats Webseiten Statistik + Counter" /></a></noscript>
<!-- 4stats Tracker Code // end -->
</div>
</body>
</html>

