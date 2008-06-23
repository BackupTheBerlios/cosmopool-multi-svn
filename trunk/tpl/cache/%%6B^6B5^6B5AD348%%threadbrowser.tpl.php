<?php /* Smarty version 2.6.18, created on 2007-10-03 19:56:51
         compiled from threadbrowser.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  <div id="content2">

  <?php if ($this->_tpl_vars['pool']): ?>
    <a href="./index.php?page=showpool&pool_id=<?php echo $this->_tpl_vars['pool']->id; ?>
"><?php echo $this->_tpl_vars['pool']->name; ?>
</a> -> 
  <?php endif; ?>

<?php if ($this->_tpl_vars['form']): ?>
  <a href="./index.php?page=threadbrowser&pool_id=<?php echo $this->_tpl_vars['pool']->id; ?>
&thread=<?php echo $this->_tpl_vars['thread']->id; ?>
"><?php echo $this->_tpl_vars['thread']->title; ?>
</a> ->
  <?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'threadbrowser_newentry_hier'), $this);?>

  <br><br><?php echo $this->_tpl_vars['form']; ?>
<br>

<?php else: ?>
  <b><?php echo $this->_tpl_vars['thread']->title; ?>
</b><br><br>
<?php endif; ?>

<?php if ($this->_tpl_vars['entries']): ?>
<table class="pools">

<?php $_from = $this->_tpl_vars['entries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['entry_id'] => $this->_tpl_vars['entry']):
?>
<tr><td class="pools"><?php echo $this->_tpl_vars['entry']->text; ?>

</tr></td>
<tr><td class="pools"><b><?php echo $this->_tpl_vars['entry']->getDateFormat(); ?>
</b> <?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'threadbrowser_by'), $this);?>

<a href="./index.php?page=showmember&showmember=<?php echo $this->_tpl_vars['entry']->user_id; ?>
"><?php echo $this->_tpl_vars['entry']->user->name; ?>
</a>
</tr></td>
<tr><td>&nbsp;
</tr></td>
<?php endforeach; endif; unset($_from); ?>
<tr><td class="pools" align="right"><a href="./index.php?page=threadbrowser&pool_id=<?php echo $this->_tpl_vars['pool']->id; ?>
&thread=<?php echo $this->_tpl_vars['thread']->id; ?>
&action=new_entry"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'threadbrowser_newentry_link'), $this);?>
</a>
</tr></td>

</table>
<?php endif; ?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>