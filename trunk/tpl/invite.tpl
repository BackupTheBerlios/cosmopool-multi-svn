{include file="header.tpl"}
  <div id="content2">

{lang->getMsg p1='invite_welcome'}<br><br>

<form action="./index.php" method="post" name="InviteForm" id="InviteForm">
<div>
<input name="page" type="hidden" value="invite" />
<table border="0">
<tr><td class="forms7">{lang->getMsg p1='invite_form_emails'}:</td>
  <td class="forms2" valign="top" align="left">
  <textarea rows="5" cols="40" name="emails"></textarea><br>
  {lang->getMsg p1='invite_seperate_emails'}</td></tr><tr>
  <td class="forms7">{lang->getMsg p1='invite_form_message'}:</td>
  <td class="forms2" valign="top" align="left">
  <textarea rows="7" cols="50" name="message"></textarea></td></tr><tr>
  <td class="forms7">{lang->getMsg p1='invite_form_wholemessage'}:</td>
  <td class="forms2">[{lang->getMsg p1='whole_your_msg'}]<br><br>
  {lang->getMsg p1='invite_body'}
  </td></tr><tr>
  <td class="forms2"></td>
  <td class="forms2" valign="top" align="left">
  <input name="submit" value="{lang->getMsg p1='invite_form_submit'}" type="submit" />
  </td></tr>

</table>
</div>
</form>
 
{include file="footer.tpl"}