<?php /* Smarty version 2.6.18, created on 2007-10-04 02:04:45
         compiled from pm.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

  <?php if ($this->_tpl_vars['function'] == 'new'): ?>
  <?php if ($this->_tpl_vars['recipient']): ?>
<div id="subnavi">
  <a href="javascript:window.back()" class="subnavi_linkclosed"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'showmember_back'), $this);?>
</a><span class="subnavi_linkclosed"></span>
</div>
  <?php else: ?><div id="subnavi"><a href="./index.php?page=pm&function=inbox" class="subnavi_linkclosed"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pm_navi_inbox'), $this);?>
</a><a href="./index.php?page=pm&function=sent" class="subnavi_linkclosed"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pm_navi_sent'), $this);?>
</a><span class="subnavi_linkclosed"></span></div><div id="subnavi3"><span class="subnavi_linkactive"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pm_navi_new'), $this);?>
</span><span class="subnavi_linkclosed"></span></div><?php endif; ?>
  <?php endif; ?>
  <?php if ($this->_tpl_vars['function'] == 'sent'): ?><div id="subnavi"><a href="./index.php?page=pm&function=inbox" class="subnavi_linkclosed"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pm_navi_inbox'), $this);?>
</a><span class="subnavi_linkactive"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pm_navi_sent'), $this);?>
</span><span class="subnavi_linkclosed"></span></div><div id="subnavi3"><a href="./index.php?page=pm&function=new" class="subnavi_linkclosed"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pm_navi_new'), $this);?>
</a><span class="subnavi_linkclosed"></span></div><?php endif; ?>
  <?php if ($this->_tpl_vars['function'] == 'inbox'): ?><div id="subnavi"><span class="subnavi_linkactive"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pm_navi_inbox'), $this);?>
</span><a href="./index.php?page=pm&function=sent" class="subnavi_linkclosed"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pm_navi_sent'), $this);?>
</a><span class="subnavi_linkclosed"></span></div><div id="subnavi3"><a href="./index.php?page=pm&function=new" class="subnavi_linkclosed"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pm_navi_new'), $this);?>
</a><span class="subnavi_linkclosed"></span></div><?php endif; ?>
  <?php if ($this->_tpl_vars['function'] == 'view'): ?><div id="subnavi"><a href="javascript:window.back()" class="subnavi_linkclosed"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pm_navi_backtolist'), $this);?>
</a><span class="subnavi_linkclosed"></span></div><?php endif; ?>
  <div id="content2">


<?php if ($this->_tpl_vars['function'] == 'view'): ?>
  <table class="pools">
    <tr>
		<td class="pools4" width="100" valign="top"><b>
		<?php if ($this->_tpl_vars['view']->recipient): ?><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pm_view_to'), $this);?>
:
		<?php else: ?><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pm_view_from'), $this);?>
:
		<?php endif; ?></b></td>
		<td class="pools4" valign="top">
		<?php if ($this->_tpl_vars['view']->recipient): ?><?php echo $this->_tpl_vars['view']->recipient->name; ?>

		<?php else: ?><?php echo $this->_tpl_vars['view']->sender->name; ?>

		<?php endif; ?></td>
    </tr>
    <tr>
		<td class="pools4" width="100" valign="top"><b><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pm_view_title'), $this);?>
:</b></td>
		<td class="pools4" valign="top"><?php echo $this->_tpl_vars['view']->title; ?>
</td>
    </tr>
    <tr>
		<td class="pools4" width="100" valign="top"><b><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pm_view_body'), $this);?>
:</b></td>
		<td class="pools4" valign="top"><?php echo $this->_tpl_vars['view']->body; ?>

		<?php if ($this->_tpl_vars['view']->sender): ?><br><br><a href="./index.php?page=pm&function=new&recipient=<?php echo $this->_tpl_vars['view']->sender->id; ?>
&answer=<?php echo $this->_tpl_vars['view']->id; ?>
"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pm_view_answer'), $this);?>
</a>
		 | <a href="./index.php?page=pm&function=inbox&delete=<?php echo $this->_tpl_vars['view']->id; ?>
"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pm_view_delete'), $this);?>
</a><?php endif; ?>
		</td>
    </tr>
  </table>
<?php endif; ?>

<?php if ($this->_tpl_vars['function'] == 'inbox'): ?>
<?php if ($this->_tpl_vars['inbox']): ?>
  <table class="pools">
    <tr><th class="pools2"></th><th class="pools2"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pm_inbox_by'), $this);?>
</th><th class="pools2"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pm_inbox_do'), $this);?>
</th></tr>
    <?php $_from = $this->_tpl_vars['inbox']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['msg']):
?>
    <tr>
		<td class="pools4" valign="top"><b><?php if ($this->_tpl_vars['msg']->is_read == 0): ?><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pm_inbox_new'), $this);?>
: <?php endif; ?><a href="./index.php?page=pm&function=view&msg_id=<?php echo $this->_tpl_vars['msg']->id; ?>
"><?php echo $this->_tpl_vars['msg']->title; ?>
</a></b></td>
		<td class="pools4" width="160" valign="top"><a href="./index.php?page=showmember&showmember=<?php echo $this->_tpl_vars['msg']->sender->id; ?>
"><?php echo $this->_tpl_vars['msg']->sender->name; ?>
</a><br>
		<b><?php echo $this->_tpl_vars['msg']->getDate(); ?>
</b>
      </td>
		<td class="pools4" width="115" valign="top"><a href="./index.php?page=pm&function=inbox&delete=<?php echo $this->_tpl_vars['msg']->id; ?>
"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pm_inbox_delete'), $this);?>
</a>
		<?php if ($this->_tpl_vars['msg']->is_read == 0): ?><br>
		<a href="./index.php?page=pm&function=inbox&markread=<?php echo $this->_tpl_vars['msg']->id; ?>
"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pm_inbox_markread'), $this);?>
</a><?php endif; ?></td>
    </tr>
    <?php endforeach; endif; unset($_from); ?>
  </table>
<?php else: ?>
<?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pm_inbox_nomsgs'), $this);?>

<?php endif; ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['function'] == 'sent'): ?>
<?php if ($this->_tpl_vars['sent']): ?>
  <table class="pools">
    <tr><th class="pools2"></th><th class="pools2"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pm_sent_to'), $this);?>
</th></tr>
    <?php $_from = $this->_tpl_vars['sent']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['msg']):
?>
    <tr>
		<td class="pools4" valign="top"><b><a href="./index.php?page=pm&function=view&msg_id=<?php echo $this->_tpl_vars['msg']->id; ?>
"><?php echo $this->_tpl_vars['msg']->title; ?>
</a></b></td>
		<td class="pools4" width="160" valign="top"><a href="./index.php?page=showmember&showmember=<?php echo $this->_tpl_vars['msg']->recipient->id; ?>
"><?php echo $this->_tpl_vars['msg']->recipient->name; ?>
</a><br>
		<b><?php echo $this->_tpl_vars['msg']->getDate(); ?>
</b>
      </td>
    </tr>
    <?php endforeach; endif; unset($_from); ?>
  </table>
<?php else: ?>
<?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pm_sent_nomsgs'), $this);?>

<?php endif; ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['function'] == 'new'): ?>
<?php if ($this->_tpl_vars['recipient']): ?>
  <table border="0">
<tr><td class="forms6"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pm_new_recipient'), $this);?>
:</td><td><?php echo $this->_tpl_vars['recipient']->name; ?>
</td>
</tr></table>
  <?php echo $this->_tpl_vars['msgform']; ?>

<?php else: ?>
<?php if ($this->_tpl_vars['adressbook']): ?>
  <table class="pools">
<?php $_from = $this->_tpl_vars['adressbook']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['adress']):
?>
<tr><td width="200">
<a href="./index.php?page=showmember&showmember=<?php echo $this->_tpl_vars['adress']->recipient->id; ?>
"><?php echo $this->_tpl_vars['adress']->recipient->name; ?>
</a>
</td><td>
(<a href="./index.php?page=pm&function=new&recipient=<?php echo $this->_tpl_vars['adress']->recipient->id; ?>
"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pm_new_writelink'), $this);?>
</a> |
<a href="./index.php?page=pm&function=new&delete=<?php echo $this->_tpl_vars['adress']->recipient->id; ?>
"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pm_new_deletecontactlink'), $this);?>
</a>)
</td></tr>
<?php endforeach; endif; unset($_from); ?>
  </table>
<?php else: ?>
<?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pm_new_empty'), $this);?>

<?php endif; ?>
<?php endif; ?>
<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>