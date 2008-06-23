<?php /* Smarty version 2.6.18, created on 2007-08-24 19:41:10
         compiled from help.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  <div id="content2">

<?php $_from = $this->_tpl_vars['headlines']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['headline']):
?>
<img src="./images/linklist_dot.png"> <a href="#<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['headline']; ?>
</a><br>
<?php endforeach; endif; unset($_from); ?>
<?php echo $this->_tpl_vars['help_content']; ?>

<div align="right"><a href="#">top</a></div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>