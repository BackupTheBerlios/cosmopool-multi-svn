<?php /* Smarty version 2.6.18, created on 2007-09-06 20:21:13
         compiled from pooladmin.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  <div id="content2">

<?php if ($this->_tpl_vars['admins']): ?>
<p class="standard"><b><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pooladmin_adminlist_header'), $this);?>
</b>: 
<?php $_from = $this->_tpl_vars['admins']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['member']):
?>
<?php if ($this->_tpl_vars['member']['detail']): ?>
<?php if ($this->_tpl_vars['member']['count'] != 1): ?>
</p><p class="standard">
<?php endif; ?>
<b><?php echo $this->_tpl_vars['member']['obj']->name; ?>
</b><br>
<?php echo $this->_tpl_vars['member']['obj']->street; ?>
 <?php echo $this->_tpl_vars['member']['obj']->house; ?>
<br>
<?php echo $this->_tpl_vars['member']['obj']->plz; ?>
 <?php echo $this->_tpl_vars['member']['obj']->city; ?>
<br>
<?php echo $this->_tpl_vars['member']['obj']->email; ?>
<br>
<?php echo $this->_tpl_vars['member']['obj']->phone; ?>

</p><p class="standard">
<?php else: ?>
<a href="./index.php?page=pooladmin&pool_id=<?php echo $this->_tpl_vars['pool']->id; ?>
&showadmin=<?php echo $this->_tpl_vars['member']['obj']->id; ?>
"><?php echo $this->_tpl_vars['member']['obj']->name; ?>
</a>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
</p>
<?php endif; ?>

<?php if ($this->_tpl_vars['members']): ?>
<p class="standard"><b><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pooladmin_memberlist_header'), $this);?>
</b>: 
<?php $_from = $this->_tpl_vars['members']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['member']):
?>
<?php if ($this->_tpl_vars['member']['detail']): ?>
<?php if ($this->_tpl_vars['member']['count'] != 1): ?>
</p><p class="standard">
<?php endif; ?>
<b><?php echo $this->_tpl_vars['member']['obj']->name; ?>
</b><br>
<?php echo $this->_tpl_vars['member']['obj']->street; ?>
 <?php echo $this->_tpl_vars['member']['obj']->house; ?>
<br>
<?php echo $this->_tpl_vars['member']['obj']->plz; ?>
 <?php echo $this->_tpl_vars['member']['obj']->city; ?>
<br>
<?php echo $this->_tpl_vars['member']['obj']->email; ?>
<br>
<?php echo $this->_tpl_vars['member']['obj']->phone; ?>

</p><p class="standard">
<?php else: ?>
<a href="./index.php?page=pooladmin&pool_id=<?php echo $this->_tpl_vars['pool']->id; ?>
&showmember=<?php echo $this->_tpl_vars['member']['obj']->id; ?>
"><?php echo $this->_tpl_vars['member']['obj']->name; ?>
</a>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
</p>
<?php endif; ?>

<?php if ($this->_tpl_vars['new_admins']): ?>
<p class="headline2" id="anzeigen"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pooladmin_addadmins_header'), $this);?>
</p>
<?php if ($this->_tpl_vars['really_add_admin']): ?>
<p class="standard"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pooladmin_addadmins_reallyadd_text-1'), $this);?>
<?php echo $this->_tpl_vars['really_add_admin']->name; ?>
<?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pooladmin_addadmins_reallyadd_text-2'), $this);?>
<a href="./index.php?page=pooladmin&action=new_admin&user=<?php echo $this->_tpl_vars['really_add_admin']->id; ?>
&pool_id=<?php echo $this->_tpl_vars['pool']->id; ?>
&really=yes"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pooladmin_addadmins_reallyadd_yes'), $this);?>
</a> | <a href="./index.php?page=pooladmin&pool_id=<?php echo $this->_tpl_vars['pool']->id; ?>
"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pooladmin_addadmins_reallyadd_no'), $this);?>
</a></p>
<?php endif; ?>
<p class="standard">
<?php $_from = $this->_tpl_vars['new_admins']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['admin']):
?>
  <a href="./index.php?page=pooladmin&action=new_admin&user=<?php echo $this->_tpl_vars['admin']->id; ?>
&pool_id=<?php echo $this->_tpl_vars['pool']->id; ?>
"><?php echo $this->_tpl_vars['admin']->name; ?>
</a>
<?php endforeach; endif; unset($_from); ?>
</p>
<?php endif; ?>

<?php if ($this->_tpl_vars['kick_user']): ?>
<p class="headline2" id="anzeigen"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pooladmin_kickmember_header'), $this);?>
</p>
<?php if ($this->_tpl_vars['really_kick_member']): ?>
<p class="standard"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pooladmin_kickmember_reallykick_text-1'), $this);?>
<?php echo $this->_tpl_vars['really_kick_member']->name; ?>
<?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pooladmin_kickmember_reallykick_text-2'), $this);?>
<a href="./index.php?page=pooladmin&action=kick_user&user=<?php echo $this->_tpl_vars['really_kick_member']->id; ?>
&pool_id=<?php echo $this->_tpl_vars['pool']->id; ?>
&really=yes"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pooladmin_kickmember_reallykick_yes'), $this);?>
</a> | <a href="./index.php?page=pooladmin&pool_id=<?php echo $this->_tpl_vars['pool']->id; ?>
"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pooladmin_kickmember_reallykick_no'), $this);?>
</a></p>
<?php endif; ?>
<p class="standard">
<?php $_from = $this->_tpl_vars['kick_user']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['user']):
?>
  <a href="./index.php?page=pooladmin&action=kick_user&user=<?php echo $this->_tpl_vars['user']->id; ?>
&pool_id=<?php echo $this->_tpl_vars['pool']->id; ?>
"><?php echo $this->_tpl_vars['user']->name; ?>
</a>
<?php endforeach; endif; unset($_from); ?>
</p>
<?php endif; ?>

<?php if ($this->_tpl_vars['waiting_user']): ?>
<p class="headline2" id="anzeigen"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pooladmin_freemembers_header'), $this);?>
</p>
<form action="./index.php?page=pooladmin&pool_id=<?php echo $this->_tpl_vars['pool']->id; ?>
" method="post">

  <table width="100%" class="pools">
  	 <tr>
 		 <th class="pools"> </th>
		 <th class="pools"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pooladmin_freemembers_tableheader_name'), $this);?>
</th>
		 <th class="pools"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pooladmin_freemembers_tableheader_adress'), $this);?>
</th>
		 <th class="pools"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pooladmin_freemembers_tableheader_email'), $this);?>
</th>
	 	 <th class="pools"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pooladmin_freemembers_tableheader_phone'), $this);?>
</th>
	 	 <th class="pools"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pooladmin_freemembers_tableheader_comment'), $this);?>
</th>
	 </tr>
	 <?php $_from = $this->_tpl_vars['waiting_user']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['user']):
?>
  	 <tr>
 		 <td class="pools"><input type="checkbox" value="1" name="<?php echo $this->_tpl_vars['user']['obj']->id; ?>
"></td>
		 <td class="pools"><?php echo $this->_tpl_vars['user']['obj']->name; ?>
</td>
		 <td class="pools"><?php echo $this->_tpl_vars['user']['obj']->street; ?>
 <?php echo $this->_tpl_vars['user']['obj']->house; ?>
<br><?php echo $this->_tpl_vars['user']['obj']->plz; ?>
 <?php echo $this->_tpl_vars['user']['obj']->city; ?>
</td>
		 <td class="pools"><?php echo $this->_tpl_vars['user']['obj']->email; ?>
</td>
	 	 <td class="pools">
       <?php if ($this->_tpl_vars['user']['obj']->phone_public): ?>
                <?php echo $this->_tpl_vars['user']['obj']->phone; ?>

       <?php else: ?>
                <?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pooladmin_freemembers_table_phonenotpublic'), $this);?>

       <?php endif; ?>
       </td>
	   <td class="pools"><?php echo $this->_tpl_vars['user']['comments']; ?>
</td>
	 </tr>
	 <?php endforeach; endif; unset($_from); ?>
  </table>

  <img src="./images/arrow.png"> 
  <input type="submit" name="user_accept_submit" value="<?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pooladmin_freemembers_table_submit'), $this);?>
"> / 
  <input type="submit" name="user_refuse_submit" value="<?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pooladmin_freemembers_table_clear'), $this);?>
">
</form>
<?php endif; ?>

<p class="headline2" id="anzeigen"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pooladmin_delpool_header'), $this);?>
 <font class="help">[<a href="./index.php?page=help#3"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'common_help_link'), $this);?>
</a>]</font></p>
<?php if ($this->_tpl_vars['lastadmin']): ?>

<?php if ($this->_tpl_vars['reallydelpool']): ?>
<p class="standard"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pooladmin_delpool_reallydel_text-1'), $this);?>

  <a href="index.php?page=pooladmin&pool_id=<?php echo $this->_tpl_vars['pool']->id; ?>
&action=delpool&really=yes"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pooladmin_delpool_reallydel_yes'), $this);?>
</a> | 
  <a href="./index.php?page=pooladmin&pool_id=<?php echo $this->_tpl_vars['pool']->id; ?>
"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pooladmin_delpool_reallydel_no'), $this);?>
</a>
</p>
<?php else: ?>
<p class="standard"><a href="index.php?page=pooladmin&pool_id=<?php echo $this->_tpl_vars['pool']->id; ?>
&action=delpool"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'pooladmin_delpool_link'), $this);?>
</a></p>
<?php endif; ?>

<?php else: ?>
<p class="standard">Nicht m&ouml;glich, siehe <a href="./index.php?page=help#3"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'common_help_link'), $this);?>
</a>.</p>
<?php endif; ?> 

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>