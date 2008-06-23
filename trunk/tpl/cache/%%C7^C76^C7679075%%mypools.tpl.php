<?php /* Smarty version 2.6.18, created on 2007-10-26 19:48:47
         compiled from mypools.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "./header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  <div id="content2">

<table width="100%" class="pools">
  <tr>
	 <th class="pools"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'tableheaders_name'), $this);?>
</th>
	 <th class="pools"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'tableheaders_area'), $this);?>
</th>

    <?php if ($this->_tpl_vars['mypoolstable_thirdcol']): ?>
	 <th class="pools" width="300"> </th>
	 <?php endif; ?>

  </tr>
  <?php $_from = $this->_tpl_vars['mypoolstable']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['pool']):
?>
  <tr>
	 <td class="pools1">
	   <a href="./index.php?page=showpool&pool_id=<?php echo $this->_tpl_vars['pool']['id']; ?>
&cat=0&type=0"><?php echo $this->_tpl_vars['pool']['name']; ?>
</a>
	 </td>
	 <td class="pools1"><?php echo $this->_tpl_vars['pool']['area']; ?>
</td>

    <?php if ($this->_tpl_vars['mypoolstable_thirdcol']): ?>
	 <td class="pools1"><?php echo $this->_tpl_vars['pool']['links']; ?>
</td>
	 <?php endif; ?>
	 
  </tr>
  <?php if ($this->_tpl_vars['pool']['id'] == 1): ?>
  <tr>
	 <td color="white" colspan="2">&nbsp;</td>

    <?php if ($this->_tpl_vars['mypoolstable_thirdcol']): ?>
	 <td class="pools"> </td>
	 <?php endif; ?>
	 
  </tr>

  <?php endif; ?>
  <?php endforeach; endif; unset($_from); ?>
  <tr>
    <?php if ($this->_tpl_vars['mypoolstable_thirdcol']): ?>
    <td class="pools" colspan=3>
    <?php else: ?>
    <td class="pools" colspan=2>
    <?php endif; ?>
      <a href="index.php?page=poolbrowser&function=public"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'mysite_links_poolbrowser_name'), $this);?>
</a> |
      <a href="index.php?page=pooldata"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'mysite_links_pooldata_name'), $this);?>
</a>
    </td>
  </tr>
</table>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "./footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>