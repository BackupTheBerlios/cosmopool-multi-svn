<?php /* Smarty version 2.6.18, created on 2007-08-11 02:35:30
         compiled from resdata.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array('javascript' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="subnavi">
  <a href="./index.php?page=resmanager&function=all" class="subnavi_linkclosed"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'resdata_all_header'), $this);?>
</a><span class="subnavi_linkclosed"></span>
</div>
  <div id="content2">

<?php echo $this->_tpl_vars['form']; ?>

<?php if ($this->_tpl_vars['new_res_link'] == true): ?>
<p class="standard"><a href="./index.php?page=resdata&cat=<?php echo $this->_tpl_vars['cat']; ?>
"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'resdata_link1'), $this);?>
</a> | <a href="./index.php?page=resmanager"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'resdata_link2'), $this);?>
</a></p>
<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>