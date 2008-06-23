<?php /* Smarty version 2.6.18, created on 2007-11-30 17:21:41
         compiled from header.tpl */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<meta name="description" content="<?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'html_description'), $this);?>
">
<meta name="keywords" content="<?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'html_keywords'), $this);?>
">
<title><?php echo $this->_tpl_vars['html_title']; ?>
 - <?php echo $this->_tpl_vars['header']; ?>
</title>
<link rel="stylesheet" type="text/css" href="./inc/style.css">
<?php if ($this->_tpl_vars['javascript']): ?><script src="./inc/form_resdata.js" type="text/javascript"></script><?php endif; ?>
</head>
<body class="page"<?php if ($this->_tpl_vars['javascript']): ?> onload="init(<?php echo $this->_tpl_vars['javascriptarray']; ?>
)"<?php endif; ?>>
<div id="space"> </div>
<div id="page">
  <div id="header">
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
    <?php if ($this->_tpl_vars['is_logged_in']): ?>
    <?php if ($this->_tpl_vars['act_lang'] == 'de'): ?>
    <a href="./index.php?page=logout"><img src="./images/header-links-de-2.png" class="logoutlink"></a>
    <a href="./index.php?page=help"><img src="./images/header-links-de-1.png" class="helplink"></a>
    <?php endif; ?><?php if ($this->_tpl_vars['act_lang'] == 'en'): ?>
    <a href="./index.php?page=logout"><img src="./images/header-links-en-2.png" class="logoutlink"></a>
    <a href="./index.php?page=help"><img src="./images/header-links-en-1.png" class="helplink"></a>
    <?php endif; ?><?php if ($this->_tpl_vars['act_lang'] == 'es'): ?><a href="./index.php?page=logout"><img src="./images/header-links-en-2.png" class="logoutlink"></a><a href="./index.php?page=help"><img src="./images/header-links-en-1.png" class="helplink"></a><?php endif; ?>
    <?php endif; ?></div>
    <a href="./index.php"><img src="./images/logo.png" id="logo_left"></a>
    </div>

<div id="leftcolumn">
  <br><?php echo $this->_tpl_vars['searchform']; ?>

  <?php if ($this->_tpl_vars['footerlinks']): ?>
  <div id="linklist">
    <div class="linklist_links">
      <a class="navi" href="index.php?page=userdata"> <?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'mysite_links_userdata_name'), $this);?>
</a>
    </div>
    <div class="linklist_links">
      <a class="navi" href="index.php?page=resmanager"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'mysite_res_header'), $this);?>
</a>
    </div>
<?php if ($this->_tpl_vars['borrowed_res']): ?>
    <div class="linklist_links2">
    <a class="navi" href="./index.php?page=resmanager&function=borrowed"> <?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'resmanager_borrowed_header'), $this);?>
</a>
    </div>
<?php endif; ?>
    <div class="linklist_links2">
    <a class="navi" href="./index.php?page=resmanager&function=all"> <?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'resmanager_all_header'), $this);?>
</a>
    </div>
    <div class="linklist_links2">
    <a class="navi" href="index.php?page=resdata"> <?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'mysite_links_resdata_name'), $this);?>
</a>
    </div>
    <div class="linklist_links">
      <a class="navi" href="index.php?page=mypools"> <?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'mysite_mypools_header'), $this);?>
</a>
    </div>
    <div class="linklist_links">
      <a class="navi" href="index.php?page=pm"> <?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'common_footerlinks_pm'), $this);?>
</a>
    </div>
    <div class="linklist_links">
      <a class="navi" href="index.php?page=invite"> <?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'common_footerlinks_invite'), $this);?>
</a>
    </div>
  </div>
  <?php else: ?>
  <div id="linklist">
        <a class="navi" href="index.php?page=home"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'homepage_backlink'), $this);?>
</a>
  </div>
  
  <?php endif; ?>
  <?php if ($this->_tpl_vars['todo']): ?> 
  <div id="todolist">
    <b>toDo</b><br><br>
    <div id="todolist_links">
      <?php if ($this->_tpl_vars['todo']['res']): ?>
      / <a href="index.php?page=resmanager"><?php echo $this->_tpl_vars['todo']['res']; ?>
 <?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'common_todo_request'), $this);?>
</a>
      <?php endif; ?>
      <?php if ($this->_tpl_vars['todo']['user']): ?>
      <?php $_from = $this->_tpl_vars['todo']['user']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['pool']):
?>
      <br><br><b><?php echo $this->_tpl_vars['pool']['pool']->name; ?>
</b>:<br>
		\ <a href="index.php?page=pooladmin&pool_id=<?php echo $this->_tpl_vars['pool']['pool']->id; ?>
"><?php echo $this->_tpl_vars['pool']['count']; ?>
 <?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'common_todo_userswait'), $this);?>
</a>
		<?php endforeach; endif; unset($_from); ?>
      <?php endif; ?>
      <?php if ($this->_tpl_vars['todo']['msgs']): ?>
      / <a href="index.php?page=pm"><?php echo $this->_tpl_vars['todo']['msgs']; ?>
 <?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'common_todo_msgs'), $this);?>
<?php if ($this->_tpl_vars['todo']['msgs'] > 1): ?><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'common_todo_msgs_plural'), $this);?>
<?php endif; ?></a>
      <?php endif; ?>
    </div>
  </div>
   
  <?php endif; ?>
</div>

  <div id="content">
  <?php $_from = $this->_tpl_vars['msg']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['msg']):
?>
  <span class="msgtop">
  <font color="#000000">&nbsp;</font> <?php echo $this->_tpl_vars['msg']; ?>
 <font color="#000000">&nbsp;</font>
  </span>
  <?php endforeach; endif; unset($_from); ?>
  <div id="headline"><?php echo $this->_tpl_vars['header']; ?>
</div>
