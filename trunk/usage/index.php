<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang='de'>
<head>
<meta name="robots" content="noindex,nofollow" />
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="description" content="Awstats - Advanced Web Statistics for www.speedpartner.de" />
<title>Statistik f&uuml;r <?=$_SERVER[SERVER_NAME] ?></title>
<style type="text/css">
<!--
body { font: 11px verdana, arial, helvetica, sans-serif; background-color: #FFFFFF; margin-top: 0; margin-bottom: 0; }
.aws_bodyl  { }
.aws_border { background-color: #CCCCDD; padding: 1px 1px 1px 1px; margin-top: 0; margin-bottom: 0; }
.aws_title  { font: 13px verdana, arial, helvetica, sans-serif; font-weight: bold; background-color: #CCCCDD; text-align: center; margin-top: 0; margin-bottom: 0; padding: 1px 1px 1px 1px; }
.aws_blank  { font: 13px verdana, arial, helvetica, sans-serif; background-color: #CCCCDD; text-align: center; margin-bottom: 0; padding: 1px 1px 1px 1px; }
.aws_data {
	background-color: #FFFFFF;
	border-top-width: 1px;   
	border-left-width: 0px;  
	border-right-width: 0px; 
	border-bottom-width: 0px;
}
.aws_formfield { font: 13px verdana, arial, helvetica; }
.aws_button {
	font-family: arial,verdana,helvetica, sans-serif;
	font-size: 12px;
	border: 1px solid #ccd7e0;
	background-image : url(/awstatsicons/other/button.gif);
}
th		{ border-color: #ECECEC; border-left-width: 0px; border-right-width: 1px; border-top-width: 0px; border-bottom-width: 1px; padding: 1px 2px 1px 1px; font: 11px verdana, arial, helvetica, sans-serif; text-align:center; color: #000000; }
th.aws	{ border-color: #ECECEC; border-left-width: 0px; border-right-width: 1px; border-top-width: 0px; border-bottom-width: 1px; padding: 1px 2px 1px 1px; font-size: 13px; font-weight: bold; }
td		{ border-color: #ECECEC; border-left-width: 0px; border-right-width: 1px; border-top-width: 0px; border-bottom-width: 1px; padding: 1px 1px 1px 1px; font: 11px verdana, arial, helvetica, sans-serif; text-align:center; color: #000000; }
td.aws	{ border-color: #ECECEC; border-left-width: 0px; border-right-width: 1px; border-top-width: 0px; border-bottom-width: 1px; padding: 1px 1px 1px 1px; font: 11px verdana, arial, helvetica, sans-serif; text-align:left; color: #000000; }
td.awsm	{ border-left-width: 0px; border-right-width: 0px; border-top-width: 0px; border-bottom-width: 0px; padding: 0px 0px 0px 0px; font: 11px verdana, arial, helvetica, sans-serif; text-align:left; color: #000000; }
b { font-weight: bold; }
a { font: 11px verdana, arial, helvetica, sans-serif; }
a:link    { color: #0011BB; text-decoration: none; }
a:visited { color: #0011BB; text-decoration: none; }
a:hover   { color: #605040; text-decoration: underline; }
//-->
</style>
</head>

<body style="margin-top: 0px">
<a name="top">&nbsp;</a>
<a name="menu">&nbsp;</a>
<table class="aws_border" border="0" cellpadding="2" cellspacing="0" width="100%">
<tr><td>
<table class="aws_data" border="0" cellpadding="1" cellspacing="0" width="100%">
<tr>
  <td class="aws" nowrap valign="middle"><b>Statistik f&uuml;r:</b>&nbsp;</td>
  <td width="100%" class="aws" nowrap><span style="font-size: 14px;"><?=$_SERVER[SERVER_NAME] ?></span></td>
</tr>
</table>
</td></tr></table>
<br>
<br>
<?php
  setlocale(LC_TIME,'de_DE');
  $found=array();
  $dh=opendir('.');
  while ( $file=readdir($dh) )
  {
    if (eregi('awstats\.([0-9]{2})([0-9]{4}).html',$file,$reg))
    {
      $found[$reg[2].'-'.$reg[1]]=$reg[0];
    }
  }
  closedir($dh);
  krsort($found);
  reset($found);
  while ( list($year_month,$link) = each($found) )
  {
    list($year,$month)=split("-",$year_month);
    echo '<a href="'.$link.'">Besucherstatistik '.strftime('%B %Y',mktime(0,0,0,$month,1,$year)).'</a><br>';
  }
  
?>
</body>
</html>