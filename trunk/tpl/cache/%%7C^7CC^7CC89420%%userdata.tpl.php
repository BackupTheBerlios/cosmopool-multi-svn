<?php /* Smarty version 2.6.18, created on 2007-09-10 17:20:57
         compiled from userdata.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="subnavi">
  <?php if ($this->_tpl_vars['function'] == data): ?><span class="subnavi_linkactive"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'userdata_navi_data'), $this);?>
</span><a href="./index.php?page=userdata&function=password" class="subnavi_linkclosed"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'userdata_navi_password'), $this);?>
</a><a href="./index.php?page=userdata&function=photos" class="subnavi_linkclosed"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'userdata_navi_photos'), $this);?>
</a><span class="subnavi_linkclosed"></span><?php endif; ?>
  <?php if ($this->_tpl_vars['function'] == password): ?><a href="./index.php?page=userdata&function=data" class="subnavi_linkclosed"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'userdata_navi_data'), $this);?>
</a><span class="subnavi_linkactive"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'userdata_navi_password'), $this);?>
</span><a href="./index.php?page=userdata&function=photos" class="subnavi_linkclosed"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'userdata_navi_photos'), $this);?>
</a><span class="subnavi_linkclosed"></span><?php endif; ?>
  <?php if ($this->_tpl_vars['function'] == photos): ?><a href="./index.php?page=userdata&function=data" class="subnavi_linkclosed"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'userdata_navi_data'), $this);?>
</a><a href="./index.php?page=userdata&function=password" class="subnavi_linkclosed"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'userdata_navi_password'), $this);?>
</a><span class="subnavi_linkactive"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'userdata_navi_photos'), $this);?>
</span><span class="subnavi_linkclosed"></span><?php endif; ?>
</div>

<?php if ($this->_tpl_vars['function'] == data): ?>
  <div id="content2">
<?php echo $this->_tpl_vars['text']; ?>
<br><br>
<?php echo $this->_tpl_vars['form']; ?>

<?php endif; ?>
<?php if ($this->_tpl_vars['function'] == password): ?>
  <div id="content2">
<?php echo $this->_tpl_vars['text']; ?>
<br><br>
<?php echo $this->_tpl_vars['form']; ?>

<?php endif; ?>
<?php if ($this->_tpl_vars['function'] == photos): ?>
<?php if ($this->_tpl_vars['photos']): ?>

  <div id="content5">
<?php echo $this->_tpl_vars['text']; ?>
<br><br>
<?php $_from = $this->_tpl_vars['photos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['photo']):
?>
<div class="photo3"><a class="picture" href="./index.php?page=userdata&function=photos&setmain=<?php echo $this->_tpl_vars['photo']['id']; ?>
"><img src="./images/uploads/thumb_<?php echo $this->_tpl_vars['photo']['name']; ?>
" 
<?php if ($this->_tpl_vars['mainphoto'] == $this->_tpl_vars['photo']['id']): ?>class="photo2"<?php else: ?>class="photo"<?php endif; ?>></a><br>
<a class="picture" href="./index.php?page=showpicture&id=<?php echo $this->_tpl_vars['photo']['obj']->name; ?>
" target="ueber" onclick="javascript: window.open(this,'ueber','width=432,height=<?php echo $this->_tpl_vars['photo']['obj']->getHeight(); ?>
,scrollbars=yes');"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'userdata_photos_big'), $this);?>
</a> |&nbsp; <a class="picture" href="./index.php?page=userdata&function=photos&delete=<?php echo $this->_tpl_vars['photo']['id']; ?>
"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'userdata_photos_delete'), $this);?>
</a></div><?php endforeach; endif; unset($_from); ?>
</div><div id="subnavi2"></div>

<?php endif; ?>
<div id="content2">

<?php echo $this->_tpl_vars['form']; ?>

<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>