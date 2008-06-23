<?php /* Smarty version 2.6.18, created on 2008-01-06 18:47:58
         compiled from showpool.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="resnavi3">
<?php if ($this->_tpl_vars['pool']->id != 1): ?>
  <div class="resnavi4"><b><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'showpool_do'), $this);?>
</b></div>
  <div class="resnavi5">
  <?php if ($this->_tpl_vars['not_member']): ?>
    <?php if ($this->_tpl_vars['become_member_form']): ?>
    <form action="./index.php?page=showpool&pool_id=<?php echo $this->_tpl_vars['pool']->id; ?>
&action=become_member" method="POST">
    <p class="headline2"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'showpool_become_member_header'), $this);?>
</p>
    <p class="standard"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'showpool_become_member_cancomment'), $this);?>
</p>
    <textarea name="become_member_comments" cols="30" rows="5"></textarea><br>
    <input type="submit" name="become_member_submit" value="<?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'showpool_become_member_submit'), $this);?>
">
    <?php else: ?>
      <?php if ($this->_tpl_vars['pool']->is_public == 1): ?>
    <p class="standard"><a href="./index.php?page=showpool&pool_id=<?php echo $this->_tpl_vars['pool']->id; ?>
&action=become_member"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'showpool_become_member_public_link'), $this);?>
</a></p>
      <?php else: ?>
    <p class="standard"><a href="./index.php?page=showpool&pool_id=<?php echo $this->_tpl_vars['pool']->id; ?>
&action=become_member"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'showpool_become_member_link'), $this);?>
</a></p>
      <?php endif; ?>
    <?php endif; ?>
  <?php else: ?>
    <?php if ($this->_tpl_vars['user_is_waiting']): ?>
    <p class="msg"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'showpool_become_member_msg_isproven'), $this);?>
</p>
    <?php else: ?>
    <p class="standard"><a href="./index.php?page=showpool&pool_id=<?php echo $this->_tpl_vars['pool']->id; ?>
&action=no_member"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'showpool_leavepool_link'), $this);?>
</a><br>
    <a href="./index.php?page=freeres&pool_id=<?php echo $this->_tpl_vars['pool']->id; ?>
"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'showpool_freeres_link'), $this);?>
</a></p>
    <?php endif; ?>
  <?php endif; ?>
  </div>
<?php endif; ?>
<?php if ($this->_tpl_vars['cats']): ?>
  <div class="resnavi4"><b><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'showpool_res_header'), $this);?>
</b></div>
  <div class="resnavi5"><br>
  <?php $_from = $this->_tpl_vars['cats']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cat_id'] => $this->_tpl_vars['cat']):
?>
  <?php if ($this->_tpl_vars['cat_id'] == 0): ?><br><?php endif; ?>
        <a href="./index.php?page=resbrowser&searchwhere=<?php echo $this->_tpl_vars['pool']->id; ?>
&cat=<?php echo $this->_tpl_vars['cat_id']; ?>
"><?php echo $this->_tpl_vars['cat']['name']; ?>
</a>
        (<?php echo $this->_tpl_vars['cat']['count']; ?>
)<br>
  <?php endforeach; endif; unset($_from); ?><br>
  </div>
<?php endif; ?>
<?php if ($this->_tpl_vars['isadmin']): ?>
  <div class="resnavi4"><b><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'showpool_admin_header'), $this);?>
</b></div>
  <div class="resnavi5"><br>
  <a href="./index.php?page=pooldata&pool_id=<?php echo $this->_tpl_vars['pool']->id; ?>
"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'mysite_poolsadmintable_changedatalink'), $this);?>
</a><br>
  <a href="./index.php?page=pooladmin&pool_id=<?php echo $this->_tpl_vars['pool']->id; ?>
"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'mysite_poolsadmintable_adminlink'), $this);?>
</a><br><br>
  </div>
<?php endif; ?>
<?php if (! $this->_tpl_vars['not_member']): ?>  <div class="resnavi4"><b><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'showpool_admins_header'), $this);?>
</b></div>
  <div class="resnavi5"><br>
    <?php $_from = $this->_tpl_vars['members']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['member']):
?><?php if ($this->_tpl_vars['member']['admin']): ?>
     <a href="./index.php?page=showmember&showmember=<?php echo $this->_tpl_vars['member']['obj']->id; ?>
"><?php echo $this->_tpl_vars['member']['obj']->name; ?>
</a><br>  
    <?php endif; ?><?php endforeach; endif; unset($_from); ?><br>
  </div>
  <?php endif; ?>
<?php if ($this->_tpl_vars['members']): ?>
  <div class="resnavi4"><b><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'showpool_members_header'), $this);?>
</b></div>
  <div class="resnavi5"><br>
    <?php $_from = $this->_tpl_vars['members']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['member']):
?><?php if (! $this->_tpl_vars['member']['admin']): ?>
     <a href="./index.php?page=showmember&showmember=<?php echo $this->_tpl_vars['member']['obj']->id; ?>
"><?php echo $this->_tpl_vars['member']['obj']->name; ?>
</a><br>  
    <?php endif; ?><?php endforeach; endif; unset($_from); ?><br><br>
  </div>
<?php endif; ?>
</div>

<div id="poolmaindata">
<div id="resnavi9"><br>
<table class=pooldesc>
<tr>
  <td class=pooldesc1><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'showpool_description'), $this);?>
: </td>
  <td class=pooldesc2><?php echo $this->_tpl_vars['pool']->getDescription(); ?>
</td>
</tr>
<tr>
  <td class=pooldesc1><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'showpool_area'), $this);?>
: </td>
  <td class=pooldesc2><?php echo $this->_tpl_vars['pool']->area; ?>
</td>
</tr>
<tr>
  <td class=pooldesc1><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'showpool_place'), $this);?>
: </td>
  <td class=pooldesc2><?php echo $this->_tpl_vars['pool']->country; ?>
-<?php echo $this->_tpl_vars['pool']->plz; ?>
 <?php echo $this->_tpl_vars['pool']->city; ?>
</td>
</tr>
<tr>
  <td class=pooldesc1><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'showpool_public'), $this);?>
: </td>
  <?php if ($this->_tpl_vars['pool']->is_public): ?>
  <td class=pooldesc2><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'tables_is_public_yes'), $this);?>

  <?php else: ?>
  <td class=pooldesc2><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'tables_is_public_no'), $this);?>

  <?php endif; ?></td>
</tr>
</table><br>
</div>
</div>

  <div id="content2">
<?php if ($this->_tpl_vars['form']): ?>
  <a href="./index.php?page=showpool&pool_id=<?php echo $this->_tpl_vars['pool']->id; ?>
"><?php echo $this->_tpl_vars['pool']->name; ?>
</a> ->
  <?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'showpool_forum_new_thread'), $this);?>

  <br><br><?php echo $this->_tpl_vars['form']; ?>
<br>

<?php else: ?>
<?php if ($this->_tpl_vars['pool']): ?>






<table class="res2">
  <tr>
    <th class="showpool" colspan="3"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'showpool_forum_header'), $this);?>

    </th>
  <tr>
<?php if ($this->_tpl_vars['threads']): ?>
  <tr>
    <th class="pools">
      <?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'showpool_forum_thread'), $this);?>

    </th>
    <th class="pools" width="250">
      <?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'showpool_forum_lastentry'), $this);?>

    </th>
  </tr>

  <?php $_from = $this->_tpl_vars['threads']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['thread_id'] => $this->_tpl_vars['thread']):
?>
    <tr>
      <td class="pools">
        <a href="./index.php?page=threadbrowser&pool_id=<?php echo $this->_tpl_vars['pool']->id; ?>
&thread=<?php echo $this->_tpl_vars['thread']['id']; ?>
"><?php echo $this->_tpl_vars['thread']['title']; ?>
</a>
      </td>
      <td class="pools">
        <?php echo $this->_tpl_vars['thread']['act_date']; ?>

      </td>
    </tr>
  <?php endforeach; endif; unset($_from); ?>
<?php else: ?>
<tr><td class="pools" align="center">--- keine Einträge ---</td></tr>
<?php endif; ?>
<tr><td>&nbsp;</td></tr>
<tr><td colspan="2" class="pools" align="right"><a href="./index.php?page=showpool&pool_id=<?php echo $this->_tpl_vars['pool']->id; ?>
&action=new_entry">neuen Thread erstellen</a></td></tr>
</table>
<?php if ($this->_tpl_vars['res_counter']): ?>
<p class="standard"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'showpool_membercount_text-1'), $this);?>
<?php echo $this->_tpl_vars['res_counter']; ?>
<?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'showpool_membercount_text-2'), $this);?>
</p>
<?php endif; ?>


<?php endif; ?>
<?php endif; ?>

    <?php $_from = $this->_tpl_vars['members']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['member']):
?><br>
<?php endforeach; endif; unset($_from); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>