<?php

/*
    Copyright 2004, 2005 Robert Griesel

    This file is part of NutziGems.

    NutziGems is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    NutziGems is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with NutziGems; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/
$lang = services::getService('lang');
$config = services::getService('config');

// userdata-form

$userdata_default_form = '<form{attributes}><table class="pools">{content}</table></form>';
$userdata_default_header = '</table><p class="headline2">{header}</p><table class="pools">';
$userdata_default_element = '<tr><td class="forms4">{label}<!-- BEGIN required --><font color="#ff0000">*</font><!-- END required -->:</td><td class="forms5" valign=\"top\" align=\"left\"><!-- BEGIN error --><font color="#ff0000">{error}</font><br /><!-- END error -->{element}</td></tr>';
$userdata_endtable_element = '<tr><td class="forms1">{label}<!-- BEGIN required --><font color="#ff0000">*</font><!-- END required -->:</td><td class="forms2" valign=\"top\" align=\"left\"><!-- BEGIN error --><font color="#ff0000">{error}</font><br /><!-- END error -->{element}</td></tr></table>';
$userdata_begintable_element = '<table class="forms"><tr><td class="forms1">{label}<!-- BEGIN required --><font color="#ff0000">*</font><!-- END required -->:</td><td class="forms2" valign=\"top\" align=\"left\"><!-- BEGIN error --><font color="#ff0000">{error}</font><br /><!-- END error -->{element}</td></tr>';
$userdata_submit_element = '<tr><td class="forms2">{label}<!-- BEGIN required --><font color="#ff0000">*</font><!-- END required --></td><td class="forms2" valign=\"top\" align=\"left\"><!-- BEGIN error --><font color="#ff0000">{error}</font><br /><!-- END error -->{element}<p class="standard">'.$lang->getMsg('forms_note_staredarenecessary-1').'<font class="msg">*</font>'.$lang->getMsg('forms_note_staredarenecessary-2').'</p></td></tr>';
$userdata_required_note = '';

// defaults

$default_form = '<form{attributes}><table class="pools">{content}</table></form>';
$default_header = '<p class="headline2">{header}</p>';
$default_element = '<tr><td class="forms1">{label}<!-- BEGIN required --><font color="#ff0000">*</font><!-- END required -->:</td><td class="forms2" valign=\"top\" align=\"left\"><!-- BEGIN error --><font color="#ff0000">{error}</font><br /><!-- END error -->{element}</td></tr>';
$zipcode_element = '<tr><td class="forms1">{label} <!-- BEGIN required --><font color="#ff0000">*</font><!-- END required -->:</td><td class="forms2" valign=\"top\" align=\"left\"><!-- BEGIN error --><font color="#ff0000">{error}</font><br /><!-- END error -->{element} <font class="help">[<a href="http://www.nutzigems.org/wiki/index.php?title=SoftwareFAQ_'.$lang->getLang().'" target="_blank">'.$lang->getMsg('common_help_link').'</a>]</font></td></tr>';
$cat_element = '<tr><td class="forms1">{label}<!-- BEGIN required --><font color="#ff0000">*</font><!-- END required -->:</td><td class="forms2" valign=\"top\" align=\"left\"><!-- BEGIN error --><font color="#ff0000">{error}</font><br /><!-- END error -->{element}</td></tr><tr><td></td><td class="forms2"><font color="#555555">('.$lang->getMsg('forms_cat_choosefirst').')</font></td></tr><tr><td colspan="2">&nbsp;</td></tr>';
$isbn_element = '<tr><td class="forms1">{label}<!-- BEGIN required --><font color="#ff0000">*</font><!-- END required -->:</td><td class="forms2" valign=\"top\" align=\"left\"><!-- BEGIN error --><font color="#ff0000">{error}</font><br /><!-- END error -->{element} ';
$isbn_submit_element = '<!-- BEGIN error --><font color="#ff0000">{error}</font><br /><!-- END error -->{element}</td></tr>';
$endtable_element = '<tr><td class="forms1">{label}<!-- BEGIN required --><font color="#ff0000">*</font><!-- END required -->:</td><td class="forms2" valign=\"top\" align=\"left\"><!-- BEGIN error --><font color="#ff0000">{error}</font><br /><!-- END error -->{element}</td></tr></table>';
$begintable_element = '<table class="forms"><tr><td class="forms1">{label}<!-- BEGIN required --><font color="#ff0000">*</font><!-- END required -->:</td><td class="forms2" valign=\"top\" align=\"left\"><!-- BEGIN error --><font color="#ff0000">{error}</font><br /><!-- END error -->{element}</td></tr>';
$submit_element = '<tr><td class="forms2">{label}<!-- BEGIN required --><font color="#ff0000">*</font><!-- END required --></td><td class="forms2" valign=\"top\" align=\"left\"><!-- BEGIN error --><font color="#ff0000">{error}</font><br /><!-- END error -->{element}<p class="standard">'.$lang->getMsg('forms_note_staredarenecessary-1').'<font class="msg">*</font>'.$lang->getMsg('forms_note_staredarenecessary-2').'</p></td></tr>';
$required_note = '';
$login_default_form = '<form{attributes}><table class="login_form_table">{content}</table></form>';
$login_default_header = '<p class="headline2">{header}</p>';
$login_default_element = '<tr><td class="login_form_table" valign=\"top\">{label}<!-- BEGIN required --><!-- END required -->:<br><!-- BEGIN error --><font color="#ff0000">{error}</font><br /><!-- END error -->{element}</td></tr>';
$login_endtable_element = '<tr><td class="forms1">{label}<!-- BEGIN required --><!-- END required -->:</td><td class="forms2" valign=\"top\" align=\"left\"><!-- BEGIN error --><font color="#ff0000">{error}</font><br /><!-- END error -->{element}</td></tr></table>';
$login_begintable_element = '<table class="forms"><tr><td class="forms1">{label}<!-- BEGIN required --><!-- END required -->:</td><td class="forms2" valign=\"top\" align=\"left\"><!-- BEGIN error --><font color="#ff0000">{error}</font><br /><!-- END error -->{element}</td></tr>';
$login_submit_element = '<tr><td class="forms2"  valign=\"top\" align=\"left\">{label}<!-- BEGIN required --><!-- END required --><!-- BEGIN error --><font color="#ff0000">{error}</font><br /><!-- END error -->{element}</td></tr><tr><td class=forms2><br><a href=./index.php?page=home&lostpassword=true>'.$lang->getMsg('home_lostpassword_link').'</a></td></tr>';
$login_required_note = '';

?>