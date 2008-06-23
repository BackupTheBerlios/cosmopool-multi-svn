<?php /* Smarty version 2.6.18, created on 2008-01-06 22:37:07
         compiled from freeres.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "./header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="content2">
<a href="./index.php?page=showpool&pool_id=<?php echo $this->_tpl_vars['user_new_pool']->id; ?>
">&laquo; <?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'freeres_back'), $this);?>
</a><br><br>

<form action="./index.php?page=freeres&pool_id=<?php echo $this->_tpl_vars['user_new_pool']->id; ?>
" method="post">
<input type="hidden" name="refer" value="<?php echo $this->_tpl_vars['refer']; ?>
">
<table class="pools">
	<tr>
		<th class="pools"> </th>
		<th class="pools"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'mysite_freerestable_header_category'), $this);?>
</th>
		<th class="pools"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'mysite_freerestable_header_name_description'), $this);?>
</th>
		<th class="pools"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'mysite_freerestable_header_since'), $this);?>
</th>
		<th class="pools"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'mysite_freerestable_header_type'), $this);?>
</th>
	</tr>

   <?php $_from = $this->_tpl_vars['userres']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['res']):
?>
	<tr>
		<td class="pools"><input type="checkbox" value="check" name="<?php echo $this->_tpl_vars['res']->id; ?>
"
		<?php if ($this->_tpl_vars['res']->isPool($this->_tpl_vars['user_new_pool']->id)): ?>checked="checked"<?php endif; ?>></td>
		<td class="pools"><?php echo $this->_tpl_vars['res']->getCatFormat(); ?>
</td>
		<td class="pools"><b><?php echo $this->_tpl_vars['res']->name; ?>
</b><br><?php echo $this->_tpl_vars['res']->description; ?>
</td>
		<td class="pools"><?php echo $this->_tpl_vars['res']->getSinceFormat(); ?>
</td>
		<td class="pools"><?php echo $this->_tpl_vars['res']->getTypeFormat(); ?>
</td>
  </tr>
  <?php endforeach; endif; unset($_from); ?>
</table>
<img src="./images/arrow.png"> <input type="submit" name="res_free_submit" value="<?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'mysite_freeres_button_submit-1'), $this);?>
"> | <input type="submit" name="no_free_submit" value="<?php if ($this->_tpl_vars['new_pool']): ?><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'mysite_freeres_button_clear'), $this);?>
<?php else: ?><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'freeres_clear_old'), $this);?>
<?php endif; ?>"> |
<?php if ($this->_tpl_vars['refer'] == 'mysite'): ?>
<a href="./index.php?page=mysite&pool_id=<?php echo $this->_tpl_vars['user_new_pool']->id; ?>
"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'freeres_cancel'), $this);?>
</a></form><br />
<?php else: ?>
<a href="./index.php?page=showpool&pool_id=<?php echo $this->_tpl_vars['user_new_pool']->id; ?>
"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'freeres_cancel'), $this);?>
</a></form><br />
<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "./footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>