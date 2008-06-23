<?php /* Smarty version 2.6.18, created on 2007-11-06 13:02:26
         compiled from resbrowser.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="resnavi">
<?php if ($this->_tpl_vars['resdata']): ?>
<?php else: ?>
<div id="resnavi9">
<?php endif; ?>
  <?php if ($this->_tpl_vars['pool']): ?>
    <a href="index.php?page=showpool&pool_id=<?php echo $this->_tpl_vars['pool']->id; ?>
"><?php echo $this->_tpl_vars['pool']->name; ?>
</a> -> 
  <?php endif; ?>
  <?php $_from = $this->_tpl_vars['hierarchie']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cat']):
?>
    <a href="./index.php?page=resbrowser&cat=<?php echo $this->_tpl_vars['cat']['id']; ?>
<?php echo $this->_tpl_vars['get_add_cat']; ?>
"><?php echo $this->_tpl_vars['cat']['name']; ?>
</a> -> 
  <?php endforeach; endif; unset($_from); ?>
<?php if ($this->_tpl_vars['resdata']): ?>
  <b><?php echo $this->_tpl_vars['resdata']['name']; ?>
</b>
<?php else: ?>
  <b><?php echo $this->_tpl_vars['act_cat']; ?>
</b>
<?php endif; ?>
<form action="./index.php?page=resbrowser&cat=<?php echo $this->_tpl_vars['act_cat_id']; ?>
<?php echo $this->_tpl_vars['get_add_cat']; ?>
" method="post">
<br><input name="searchstring" value="<?php echo $this->_tpl_vars['searchstring']; ?>
" type="text" size="17" class="inputtext2"> in 
<select name="searchwhere" class="inputtext">
<option value="<?php echo $this->_tpl_vars['pools_get']; ?>
"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'search_option_all_pools'), $this);?>
</option>
<?php $_from = $this->_tpl_vars['pools']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['userpool']):
?>
<option <?php if ($this->_tpl_vars['searchwhere'] == $this->_tpl_vars['userpool']['0']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['userpool']['0']; ?>
"><?php echo $this->_tpl_vars['userpool']['1']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
<input type="hidden" name="action" value="search">
<input type="submit" class="inputsubmit2" value="<?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'search_form_submit'), $this);?>
">
<?php if ($this->_tpl_vars['resdata']): ?>
<?php else: ?>
</div>
<?php endif; ?>
</div>
<?php if ($this->_tpl_vars['resdata']): ?>
<?php else: ?>
<div id="resnavi32"><?php if ($this->_tpl_vars['cats']): ?><div class="resnavi42"><b><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'resbrowser_refinesearch_header'), $this);?>
</b></div>
<div class="resnavi5">

    
    <?php $_from = $this->_tpl_vars['cats']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['number'] => $this->_tpl_vars['cat']):
?>
    <a href="./index.php?page=resbrowser&cat=<?php echo $this->_tpl_vars['cat']['id']; ?>
<?php echo $this->_tpl_vars['get_add_cat']; ?>
"><?php echo $this->_tpl_vars['cat']['name']; ?>
</a>(<?php echo $this->_tpl_vars['cat']['count']; ?>
)
    <?php if ($this->_tpl_vars['number'] == 0): ?>
    <div class="subcats">
    <?php $_from = $this->_tpl_vars['lowercats']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['lowercat']):
?>
    &nbsp;&nbsp;&nbsp;<a href="./index.php?page=resbrowser&cat=<?php echo $this->_tpl_vars['lowercat']['id']; ?>
<?php echo $this->_tpl_vars['get_add_cat']; ?>
"><?php echo $this->_tpl_vars['lowercat']['name']; ?>
</a>(<?php echo $this->_tpl_vars['lowercat']['count']; ?>
)<br>
    <?php endforeach; endif; unset($_from); ?>
    </div>
    <?php else: ?>
    <br>
    <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?>	
<br><br></div>
<?php endif; ?>
<?php if ($this->_tpl_vars['attributes']): ?>
<div class="resnavi42"><b>Suchoptionen</b>
</div>
<div class="resnavi5">

<?php $_from = $this->_tpl_vars['attributes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['attr']):
?>
<?php $this->assign('id', $this->_tpl_vars['attr']->id); ?>
<b><?php echo $this->_tpl_vars['attr']->getName(); ?>
:</b>
<br><input name="attribute<?php echo $this->_tpl_vars['attr']->id; ?>
" value="<?php echo $this->_tpl_vars['attribute_presets'][$this->_tpl_vars['id']]; ?>
" type="text" size="17" class="inputtext2">
<br><?php endforeach; endif; unset($_from); ?> 
<br><input type="submit" class="inputsubmit2" value="<?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'search_form_submit'), $this);?>
">
</div>
<?php endif; ?>
</div>
<?php endif; ?>
</form>
<form action="./index.php?page=resbrowser<?php echo $this->_tpl_vars['get_add']; ?>
" method="POST">
  <div id="content2">
<?php if ($this->_tpl_vars['resdata']): ?>
  <a href="./index.php?page=resbrowser&cat=<?php echo $this->_tpl_vars['act_cat_id']; ?>
&searchstring=<?php echo $this->_tpl_vars['searchstring']; ?>
&searchwhere=<?php echo $this->_tpl_vars['searchwhere']; ?>
&show_page=<?php echo $this->_tpl_vars['act_page']; ?>
">&laquo; <?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'resbrowser_backtolist'), $this);?>
</a><br><br>
<table class="res">
	<tr>
		<td class="pools3" colspan="3">
      <b><?php echo $this->_tpl_vars['resdata']['name']; ?>
</b>
	   <br><?php echo $this->_tpl_vars['resdata']['description']; ?>

	   <?php $_from = $this->_tpl_vars['resdata']['attributes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['attr']):
?>
	     <br><b><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => $this->_tpl_vars['attr']['name']), $this);?>
: </b> <?php echo $this->_tpl_vars['attr']['value']; ?>

	   <?php endforeach; endif; unset($_from); ?>

	    <br><br><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'resbrowser_owner'), $this);?>
 <a href="./index.php?page=showmember&showmember=<?php echo $this->_tpl_vars['resdata']['user_id']; ?>
"><?php echo $this->_tpl_vars['resdata']['user_name']; ?>
</a>.
	    <br><br><b><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'tables_contactdata'), $this);?>
</b><br>
	    <?php if ($this->_tpl_vars['resdata']['own_ressource']): ?>
		   <?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'tables_contactdata_youdontneed'), $this);?>

	    <?php else: ?>
	  <?php if ($this->_tpl_vars['one_public']): ?>

	                <?php echo $this->_tpl_vars['resdata']['user_name']; ?>

	                
	                <?php if ($this->_tpl_vars['resdata']['user_plz_city_public']): ?>
	                <br><?php echo $this->_tpl_vars['resdata']['user_street']; ?>
 <?php echo $this->_tpl_vars['resdata']['user_house']; ?>
<br>
	                <?php echo $this->_tpl_vars['resdata']['user_plz']; ?>
 <?php echo $this->_tpl_vars['resdata']['user_city']; ?>
<?php endif; ?>
	                
	                <?php if ($this->_tpl_vars['resdata']['user_email_public']): ?>
	                <br><?php echo $this->_tpl_vars['resdata']['user_email']; ?>
<?php endif; ?>
	                
	                <?php if ($this->_tpl_vars['resdata']['user_phone_public']): ?>
	                <?php if ($this->_tpl_vars['resdata']['user_phone']): ?><br>
	                <?php echo $this->_tpl_vars['resdata']['user_phone']; ?>
<?php endif; ?><?php endif; ?>
	  <?php else: ?>
		 <?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'tables_contactdata_isinvisible'), $this);?>

		 <?php endif; ?>
	  <?php endif; ?>

<?php if ($this->_tpl_vars['resdata']['own_ressource']): ?><?php else: ?>
	  <?php if ($this->_tpl_vars['resdata']['available']): ?>
	    <?php if ($this->_tpl_vars['resdata']['is_waiting']): ?>
	      <br><br><font class="msg"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'tables_request_running'), $this);?>
</font>
	    <?php else: ?>
         <br><br><b><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'tables_comment_for_the_owner'), $this);?>
: </b><br>
	         <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['resdata']['res_id']; ?>
">
			   <textarea name="comments" cols="30" rows="5"></textarea><br>
	         <input type="submit" name="submit" value="<?php echo $this->_tpl_vars['resdata']['resolvetype']; ?>
">
	    <?php endif; ?>
	  <?php else: ?>
	    <br><br><font class="msg"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'tables_allready_borrowed'), $this);?>
</font>
	  <?php endif; ?>
<?php endif; ?>
    </td>
  </tr>
</table>
<?php else: ?>
<?php echo $this->_tpl_vars['restable']; ?>

<p class="standard"><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'resbrowser_page'), $this);?>

<?php $_from = $this->_tpl_vars['res_count']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['c']):
?>
<?php if ($this->_tpl_vars['c'] == $this->_tpl_vars['act_page']): ?>
<b><?php echo $this->_tpl_vars['c']; ?>
</b>
<?php else: ?>
<a href="./index.php?page=resbrowser&cat=<?php echo $this->_tpl_vars['act_cat_id']; ?>
<?php echo $this->_tpl_vars['get_add_cat']; ?>
&show_page=<?php echo $this->_tpl_vars['c']; ?>
"><?php echo $this->_tpl_vars['c']; ?>
</a>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?></p>	
<?php endif; ?>
<input type="hidden" name="show_page" value="<?php echo $this->_tpl_vars['act_page']; ?>
">
<input type="hidden" name="res_id" value="<?php echo $this->_tpl_vars['resdata']['res_id']; ?>
">
</form>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>