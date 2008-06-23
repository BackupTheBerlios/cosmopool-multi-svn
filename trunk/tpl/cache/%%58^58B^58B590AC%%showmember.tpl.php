<?php /* Smarty version 2.6.18, created on 2007-11-30 18:08:47
         compiled from showmember.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="subnavi">
  <a href="javascript:window.back()" class="subnavi_linkclosed"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'showmember_back'), $this);?>
</a><span class="subnavi_linkclosed"></span>
</div>

  <div id="content2">
 
<?php if ($this->_tpl_vars['photo']): ?>
<div class="memberdiv1">
<div class="photo3"><a class="picture"
 href="./index.php?page=showpicture&id=<?php echo $this->_tpl_vars['photo']->name; ?>
" target="ueber" onclick="javascript: window.open(this,'ueber','width=432,height=<?php echo $this->_tpl_vars['photo']->getHeight(); ?>
,scrollbars=yes');"><img
  src="./images/uploads/thumb_<?php echo $this->_tpl_vars['photo']->name; ?>
" class="photo"></a></div>
</div>
<?php endif; ?>

<div<?php if ($this->_tpl_vars['photo']): ?> class="memberdiv2"<?php endif; ?>>
<table class=pooldesc><?php if ($this->_tpl_vars['member']['obj']->plz_city_public): ?>
<tr>
  <td class=pooldesc1><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'showmember_adress'), $this);?>
: </td>
  <td class=pooldesc2>
<?php echo $this->_tpl_vars['member']['obj']->street; ?>
 <?php echo $this->_tpl_vars['member']['obj']->house; ?>

<br><?php echo $this->_tpl_vars['member']['obj']->plz; ?>
 <?php echo $this->_tpl_vars['member']['obj']->city; ?>
<br>
<?php echo $this->_tpl_vars['member']['obj']->getCountry(); ?>

</td>
</tr>
<tr><?php endif; ?><?php if ($this->_tpl_vars['member']['obj']->email_public): ?>
  <td class=pooldesc1><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'showmember_email'), $this);?>
: </td>
  <td class=pooldesc2>
<?php echo $this->_tpl_vars['member']['obj']->email; ?>

</td>
</tr>
<tr><?php endif; ?><?php if ($this->_tpl_vars['member']['obj']->phone_public): ?>
  <td class=pooldesc1><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'showmember_phone'), $this);?>
: </td>
  <td class=pooldesc2>
<?php if ($this->_tpl_vars['member']['obj']->phone): ?>
<?php echo $this->_tpl_vars['member']['obj']->phone; ?>

<?php endif; ?>
</td>
</tr><?php endif; ?><?php if ($this->_tpl_vars['member']['obj']->description): ?>
<tr>
  <td class=pooldesc1><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'showmember_description'), $this);?>
: </td>
  <td class=pooldesc2><?php echo $this->_tpl_vars['member']['obj']->description; ?>

</td>
</tr><?php endif; ?>
<tr>
  <td class=pooldesc1><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'showmember_distance'), $this);?>
: </td>
  <td class=pooldesc2><?php if ($this->_tpl_vars['geodist'] == 'userfalse'): ?><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'showmember_userfalse'), $this);?>
<?php else: ?><?php if ($this->_tpl_vars['geodist'] == 'memberfalse'): ?><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'showmember_memberfalse'), $this);?>
<?php else: ?><?php echo $this->_tpl_vars['geodist']; ?>
 km<?php endif; ?><?php endif; ?>
</td>
</tr>
</table><br><a href="./index.php?page=pm&function=new&recipient=<?php echo $this->_tpl_vars['member']['obj']->id; ?>
"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'showmember_msglink'), $this);?>
</a> |
<a href="./index.php?page=showmember&showmember=<?php echo $this->_tpl_vars['member']['obj']->id; ?>
&add_to_adressbook=1"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'showmember_adressbooklink'), $this);?>
</a>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>