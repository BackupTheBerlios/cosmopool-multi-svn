<?php /* Smarty version 2.6.18, created on 2007-08-23 20:36:26
         compiled from pooldata.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  <div id="content2">

<?php if ($this->_tpl_vars['found']): ?>
  <?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pooldata_text'), $this);?>
<br><br>
<?php endif; ?>

<?php echo $this->_tpl_vars['form']; ?>

<?php if ($this->_tpl_vars['change_success_link'] == true): ?>
<p class="standard"><a href="./index.php?page=pooldata&pool_id=<?php echo $this->_tpl_vars['pool']->id; ?>
"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pooldata_link1'), $this);?>
</a>
 | <a href="./index.php?page=showpool&pool_id=<?php echo $this->_tpl_vars['pool']->id; ?>
"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pooldata_link2'), $this);?>
</a></p>
<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>