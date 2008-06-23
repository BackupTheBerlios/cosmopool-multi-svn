<?php /* Smarty version 2.6.18, created on 2008-01-27 21:16:17
         compiled from mysite.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "./header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

  <div id="content4">
<div class="content4header"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'mysite_mypools_header'), $this);?>
</div><br>
<div id="content4links">
<?php $_from = $this->_tpl_vars['mypoolstable']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['pool']):
?>
<img src="./images/linklist_dot.png"> <a href="./index.php?page=showpool&pool_id=<?php echo $this->_tpl_vars['pool']['id']; ?>
"><?php echo $this->_tpl_vars['pool']['name']; ?>
</a><br>
<?php endforeach; endif; unset($_from); ?><br>
<a href="index.php?page=poolbrowser&function=public"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'mysite_links_poolbrowser_name'), $this);?>
</a>
  </div></div><div id="content3">

<?php if ($this->_tpl_vars['new_pool']): ?>
<div class="supermsg"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'mysite_freeres_msg-1'), $this);?>

"<?php echo $this->_tpl_vars['new_pool']->name; ?>
"
<?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'mysite_freeres_msg-2'), $this);?>
<br><br>
<?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'mysite_freeres_msg-3'), $this);?>
: 
<a href="./index.php?page=freeres&pool_id=<?php echo $this->_tpl_vars['new_pool']->id; ?>
&refer=mysite"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'mysite_freeres_msg-4'), $this);?>
</a> |
<a href="./index.php?page=mysite&function=freenone&freenone_pool_id=<?php echo $this->_tpl_vars['new_pool']->id; ?>
"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'mysite_freeres_msg-5'), $this);?>
</a></div><br><br>
<?php endif; ?>

<?php if ($this->_tpl_vars['registered_msg'] == true): ?>
<div class="supermsg"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'mysite_registered'), $this);?>
<br><br>
[<a href="./index.php?page=userdata&"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'mysite_registered_link_userdata'), $this);?>
</a> | <a href="./index.php?page=mysite&function=noregistered&"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'mysite_registered_link_nomore'), $this);?>
</a>]</div><br><br>
<?php endif; ?>

<?php if ($this->_tpl_vars['welcome_msg'] == true): ?>
<div class="welcomemsg"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'mysite_welcome'), $this);?>
<br><br>
[<a href="./index.php?page=mysite&function=nowelcome&"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'mysite_nowelcome'), $this);?>
</a>]</div><br><br>
<?php endif; ?>

<table class="pools">
  <tr>
	<th class="pools"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'mysite_res_header'), $this);?>
</th>
	<th class="pools" width=25>&nbsp;</th>
	<th class="pools"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'mysite_userdata_header'), $this);?>
</th>
  </tr>
  <tr>
	<td class="pools1">
     <img src="./images/linklist_dot.png"> <a href="index.php?page=resmanager"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'mysite_links_resmanager_name'), $this);?>
</a><br>
     <img src="./images/linklist_dot.png"> <a href="index.php?page=resdata"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'mysite_links_resdata_name'), $this);?>
</a><br>
	</td>

	<td class="pools1"></td>

	<td class="pools1">
     <img src="./images/linklist_dot.png"> <a href="index.php?page=userdata&function=data"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'mysite_links_userdata_name'), $this);?>
</a><br>
     <img src="./images/linklist_dot.png"> <a href="index.php?page=userdata&function=password"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'mysite_links_userdatapassword_name'), $this);?>
</a><br>
     <img src="./images/linklist_dot.png"> <a href="index.php?page=userdata&function=photos"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'mysite_links_photos'), $this);?>
</a><br>
	</td>
  </tr>

<?php if ($this->_tpl_vars['borrowed']): ?>
  <tr>
	<td class="pools2">&nbsp;</td><td class="poolsblank"></td><td class="poolsblank"></td>
  </tr>
  <tr>
	<td class="pools1" colspan="3">
     <b><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'mysite_borrowed_header'), $this);?>
: </b> 
  <?php $_from = $this->_tpl_vars['borrowed']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['res']):
?><?php if ($this->_tpl_vars['key'] != 0): ?>, <?php endif; ?>"<?php echo $this->_tpl_vars['res']->name; ?>
" <?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'mysite_by'), $this);?>
 <a href="./index.php?page=showmember&showmember=<?php echo $this->_tpl_vars['res']->user->id; ?>
"><?php echo $this->_tpl_vars['res']->user->name; ?>
</a><?php endforeach; endif; unset($_from); ?>
	</td>
  </tr>
<?php endif; ?>
	
</table>
<br><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'mysite_fun'), $this);?>



<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "./footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>