<?php /* Smarty version 2.6.18, created on 2007-10-26 19:25:12
         compiled from poolbrowser.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="subnavi">
  <?php if ($this->_tpl_vars['function'] == 'public'): ?>
  <span class="subnavi_linkactive"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'poolbrowser_headers_public'), $this);?>
</span><a href="./index.php?page=poolbrowser&function=private" class="subnavi_linkclosed"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'poolbrowser_headers_private'), $this);?>
</a><span class="subnavi_linkclosed"></span>
  <?php else: ?>
  <a href="./index.php?page=poolbrowser&function=public" class="subnavi_linkclosed"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'poolbrowser_headers_public'), $this);?>
</a><span class="subnavi_linkactive"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'poolbrowser_headers_private'), $this);?>
</span><span class="subnavi_linkclosed"></span>
  <?php endif; ?>
</div>
  <div id="content2">

<?php echo $this->_tpl_vars['poolstable']; ?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>