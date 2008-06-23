<?php /* Smarty version 2.6.18, created on 2007-09-10 17:10:19
         compiled from showpicture.tpl */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title><?php echo $this->_reg_objects['lang'][0]->getMsg(array('p1' => 'html_title'), $this);?>
</title>
<link rel="stylesheet" type="text/css" href="./inc/style.css">
<?php if ($this->_tpl_vars['javascript']): ?><script src="./inc/form_resdata.js" type="text/javascript"></script><?php endif; ?>
<script src="./inc/lang_menu.js" type="text/javascript"></script>
</head>
<body class="page"<?php if ($this->_tpl_vars['javascript']): ?> onload="init(<?php echo $this->_tpl_vars['javascript']; ?>
)"<?php endif; ?>>
<img src="./images/uploads/_<?php echo $this->_tpl_vars['photo']; ?>
" class="photo4">
</body>
</html>