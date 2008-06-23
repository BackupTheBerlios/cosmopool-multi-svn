<?php /* Smarty version 2.6.18, created on 2007-08-11 02:20:41
         compiled from search.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array('javascript' => $this->_tpl_vars['javascriptarray'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  <div id="content2">

<?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'search_text'), $this);?>
<br><br>
<?php echo $this->_tpl_vars['form']; ?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>