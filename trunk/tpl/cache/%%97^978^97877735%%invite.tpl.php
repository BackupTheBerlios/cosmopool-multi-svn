<?php /* Smarty version 2.6.18, created on 2007-11-09 03:24:33
         compiled from invite.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  <div id="content2">

<?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'invite_welcome'), $this);?>
<br><br>

<form action="./index.php" method="post" name="InviteForm" id="InviteForm">
<div>
<input name="page" type="hidden" value="invite" />
<table border="0">
<tr><td class="forms7"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'invite_form_emails'), $this);?>
:</td>
  <td class="forms2" valign="top" align="left">
  <textarea rows="5" cols="40" name="emails"></textarea><br>
  <?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'invite_seperate_emails'), $this);?>
</td></tr><tr>
  <td class="forms7"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'invite_form_message'), $this);?>
:</td>
  <td class="forms2" valign="top" align="left">
  <textarea rows="7" cols="50" name="message"></textarea></td></tr><tr>
  <td class="forms7"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'invite_form_wholemessage'), $this);?>
:</td>
  <td class="forms2">[<?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'whole_your_msg'), $this);?>
]<br><br>
  <?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'invite_body'), $this);?>

  </td></tr><tr>
  <td class="forms2"></td>
  <td class="forms2" valign="top" align="left">
  <input name="submit" value="<?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'invite_form_submit'), $this);?>
" type="submit" />
  </td></tr>

</table>
</div>
</form>
 
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>