<?php /* Smarty version 2.6.18, created on 2008-01-06 19:20:58
         compiled from resmanager.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="subnavi">
  <?php if ($this->_tpl_vars['function'] == all): ?><?php if ($this->_tpl_vars['res_offers']): ?><a href="./index.php?page=resmanager&function=offers" class="subnavi_linkclosed"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'resmanager_offers_header'), $this);?>
</a><?php endif; ?><?php if ($this->_tpl_vars['borrowed_res']): ?><a href="./index.php?page=resmanager&function=borrowed" class="subnavi_linkclosed"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'resmanager_borrowed_header'), $this);?>
</a><?php endif; ?><span class="subnavi_linkactive"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'resmanager_all_header'), $this);?>
</span><span class="subnavi_linkclosed"></span><?php endif; ?>
  <?php if ($this->_tpl_vars['function'] == borrowed): ?><?php if ($this->_tpl_vars['res_offers']): ?><a href="./index.php?page=resmanager&function=offers" class="subnavi_linkclosed"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'resmanager_offers_header'), $this);?>
</a><?php endif; ?><span class="subnavi_linkactive"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'resmanager_borrowed_header'), $this);?>
</span><a href="./index.php?page=resmanager&function=all" class="subnavi_linkclosed"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'resmanager_all_header'), $this);?>
</a><span class="subnavi_linkclosed"></span><?php endif; ?>
  <?php if ($this->_tpl_vars['function'] == offers): ?><span class="subnavi_linkactive"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'resmanager_offers_header'), $this);?>
</span><?php if ($this->_tpl_vars['borrowed_res']): ?><a href="./index.php?page=resmanager&function=borrowed" class="subnavi_linkclosed"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'resmanager_borrowed_header'), $this);?>
</a><?php endif; ?><a href="./index.php?page=resmanager&function=all" class="subnavi_linkclosed"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'resmanager_all_header'), $this);?>
</a><span class="subnavi_linkclosed"></span><?php endif; ?>
</div>
  <div id="content2">


<?php if ($this->_tpl_vars['function'] == offers): ?>
  <table class="pools">
 	 <tr>
		<th class="pools"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'resmanager_offers_tableheader_what'), $this);?>
</th>
		<th class="pools"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'resmanager_offers_tableheader_offers'), $this);?>
</th>
	 </tr>
    <?php $_from = $this->_tpl_vars['res_offers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['res']):
?>
    <tr>
		<td class="pools"><b><?php echo $this->_tpl_vars['res']->name; ?>
</b><br><?php echo $this->_tpl_vars['res']->description; ?>
</td>
		<td class="pools">
      <?php $_from = $this->_tpl_vars['res']->wait; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['wait']):
?>
            <b><?php echo $this->_tpl_vars['wait']->user->name; ?>
</b><?php if ($this->_tpl_vars['wait']->comments): ?>(<b><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'resmanager_offers_comment'), $this);?>
</b>: <?php echo $this->_tpl_vars['wait']->comments; ?>
)<?php endif; ?>: <a href="./index.php?page=resmanager&function=<?php echo $this->_tpl_vars['function']; ?>
&action=wait_res_accept&wait_id=<?php echo $this->_tpl_vars['wait']->id; ?>
">
            <?php if ($this->_tpl_vars['res']->type == 0): ?>
              <?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'resmanager_offers_sendcontact'), $this);?>

            <?php endif; ?>
            <?php if ($this->_tpl_vars['res']->type == 1): ?>
              <?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'resmanager_offers_give'), $this);?>

            <?php endif; ?>
            <?php if ($this->_tpl_vars['res']->type == 2): ?>
              <?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'resmanager_offers_lend'), $this);?>

            <?php endif; ?>
            </a>, <a href="./index.php?page=resmanager&function=<?php echo $this->_tpl_vars['function']; ?>
&action=wait_res_refuse&wait_id=<?php echo $this->_tpl_vars['wait']->id; ?>
"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'resmanager_offers_clear'), $this);?>
</a>
			<br>
      <?php endforeach; endif; unset($_from); ?>
      </td>
    </tr>
    <?php endforeach; endif; unset($_from); ?>
  </table>
<?php endif; ?>

<?php if ($this->_tpl_vars['function'] == borrowed): ?>
  <table width="100%" class="pools">
 	 <tr>
		<th class="pools"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'resmanager_borrowed_tableheader_what'), $this);?>
</th>
		<th class="pools"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'resmanager_borrowed_tableheader_whom'), $this);?>
</th>
		<th class="pools"> </th>
	 </tr>
    <?php $_from = $this->_tpl_vars['borrowed_res']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['res']):
?>
    <tr>
		<td class="pools"><b><?php echo $this->_tpl_vars['res']->name; ?>
</b><br><?php echo $this->_tpl_vars['res']->description; ?>
</td>
		<td class="pools"><?php echo $this->_tpl_vars['res']->borrower->name; ?>
</td>
		<td class="pools"><a href="./index.php?page=resmanager&function=<?php echo $this->_tpl_vars['function']; ?>
&action=res_back&res_id=<?php echo $this->_tpl_vars['res']->id; ?>
"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'resmanager_borrowed_isback'), $this);?>
</a></td>
    </tr>
    <?php endforeach; endif; unset($_from); ?>
  </table>
<?php endif; ?>

<?php if ($this->_tpl_vars['function'] == all): ?>
  <form action="./index.php?page=resmanager&function=<?php echo $this->_tpl_vars['function']; ?>
" method="post">
<table width="100%" class="pools">
	<?php if ($this->_tpl_vars['userres']): ?>
	<tr>
		<th class="pools"> </th>
		<th class="pools"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'resmanager_myrestable_header_category'), $this);?>
</th>
		<th class="pools"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'resmanager_myrestable_header_name'), $this);?>
</th>
		<th class="pools" width="85"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'resmanager_myrestable_header_since'), $this);?>
</th>
		<th class="pools"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'resmanager_myrestable_header_type'), $this);?>
</th>
		<th class="pools"> </th>
	</tr>
   <?php $_from = $this->_tpl_vars['userres']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['res']):
?>
   <?php if (!(1 & $this->_tpl_vars['k'])): ?>
	<tr>
		<td class="pools1"><input type="checkbox" value="check" name="<?php echo $this->_tpl_vars['res']->id; ?>
"></td>
		<td class="pools1"><?php echo $this->_tpl_vars['res']->getCatFormat(); ?>
</td>
		<td class="pools1"><b><?php echo $this->_tpl_vars['res']->name; ?>
</b><?php if ($this->_tpl_vars['res']->getDescription()): ?><br><?php echo $this->_tpl_vars['res']->getDescription(); ?>
<?php endif; ?></td>
		<td class="pools1" width="85"><?php echo $this->_tpl_vars['res']->getSinceFormat(); ?>
</td>
		<td class="pools1"><?php echo $this->_tpl_vars['res']->getTypeFormat(); ?>
</td>
		<td class="pools1"><a href="./index.php?page=resdata&res_id=<?php echo $this->_tpl_vars['res']->id; ?>
&cat=<?php echo $this->_tpl_vars['res']->cat; ?>
">
        <?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'resmanager_myrestable_changelink'), $this);?>

    </a></td>
  </tr>
  <?php else: ?>
	<tr>
		<td class="pools2"><input type="checkbox" value="check" name="<?php echo $this->_tpl_vars['res']->id; ?>
"></td>
		<td class="pools2"><?php echo $this->_tpl_vars['res']->getCatFormat(); ?>
</td>
		<td class="pools2"><b><?php echo $this->_tpl_vars['res']->name; ?>
</b><?php if ($this->_tpl_vars['res']->getDescription()): ?><br><?php echo $this->_tpl_vars['res']->getDescription(); ?>
<?php endif; ?></td>
		<td class="pools2" width="85"><?php echo $this->_tpl_vars['res']->getSinceFormat(); ?>
</td>
		<td class="pools2"><?php echo $this->_tpl_vars['res']->getTypeFormat(); ?>
</td>
		<td class="pools2"><a href="./index.php?page=resdata&res_id=<?php echo $this->_tpl_vars['res']->id; ?>
&cat=<?php echo $this->_tpl_vars['res']->cat; ?>
">
        <?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'resmanager_myrestable_changelink'), $this);?>

    </a></td>
  </tr>
  <?php endif; ?>
  <?php endforeach; endif; unset($_from); ?>
	</table>
<img src="./images/arrow.png"> <input type="submit" name="resdata_del_submit" value="<?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'resmanager_myrestable_delmarked'), $this);?>
"></form><br />
  <?php else: ?>
	<div class="all_res">
    <tr><td colspan="6" align="center">--- <?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'resmanager_myrestable_noentrys'), $this);?>
 ---</td></tr>
	</table>
  </div>
  <?php endif; ?>
<?php endif; ?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>