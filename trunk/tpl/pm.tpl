{include file="header.tpl"}

  {if $function=='new'}
  {if $recipient}
<div id="subnavi">
  <a href="javascript:window.back()" class="subnavi_linkclosed">{lang->getMsg p1='showmember_back'}</a><span class="subnavi_linkclosed"></span>
</div>
  {else}<div id="subnavi"><a href="./index.php?page=pm&function=inbox" class="subnavi_linkclosed">{lang->getMsg p1='pm_navi_inbox'}</a><a href="./index.php?page=pm&function=sent" class="subnavi_linkclosed">{lang->getMsg p1='pm_navi_sent'}</a><span class="subnavi_linkclosed"></span></div><div id="subnavi3"><span class="subnavi_linkactive">{lang->getMsg p1='pm_navi_new'}</span><span class="subnavi_linkclosed"></span></div>{/if}
  {/if}
  {if $function=='sent'}<div id="subnavi"><a href="./index.php?page=pm&function=inbox" class="subnavi_linkclosed">{lang->getMsg p1='pm_navi_inbox'}</a><span class="subnavi_linkactive">{lang->getMsg p1='pm_navi_sent'}</span><span class="subnavi_linkclosed"></span></div><div id="subnavi3"><a href="./index.php?page=pm&function=new" class="subnavi_linkclosed">{lang->getMsg p1='pm_navi_new'}</a><span class="subnavi_linkclosed"></span></div>{/if}
  {if $function=='inbox'}<div id="subnavi"><span class="subnavi_linkactive">{lang->getMsg p1='pm_navi_inbox'}</span><a href="./index.php?page=pm&function=sent" class="subnavi_linkclosed">{lang->getMsg p1='pm_navi_sent'}</a><span class="subnavi_linkclosed"></span></div><div id="subnavi3"><a href="./index.php?page=pm&function=new" class="subnavi_linkclosed">{lang->getMsg p1='pm_navi_new'}</a><span class="subnavi_linkclosed"></span></div>{/if}
  {if $function=='view'}<div id="subnavi"><a href="javascript:window.back()" class="subnavi_linkclosed">{lang->getMsg p1='pm_navi_backtolist'}</a><span class="subnavi_linkclosed"></span></div>{/if}
  <div id="content2">


{if $function=='view'}
  <table class="pools">
    <tr>
		<td class="pools4" width="100" valign="top"><b>
		{if $view->recipient}{lang->getMsg p1='pm_view_to'}:
		{else}{lang->getMsg p1='pm_view_from'}:
		{/if}</b></td>
		<td class="pools4" valign="top">
		{if $view->recipient}{$view->recipient->name}
		{else}{$view->sender->name}
		{/if}</td>
    </tr>
    <tr>
		<td class="pools4" width="100" valign="top"><b>{lang->getMsg p1='pm_view_title'}:</b></td>
		<td class="pools4" valign="top">{$view->title}</td>
    </tr>
    <tr>
		<td class="pools4" width="100" valign="top"><b>{lang->getMsg p1='pm_view_body'}:</b></td>
		<td class="pools4" valign="top">{$view->body}
		{if $view->sender}<br><br><a href="./index.php?page=pm&function=new&recipient={$view->sender->id}&answer={$view->id}">{lang->getMsg p1='pm_view_answer'}</a>
		 | <a href="./index.php?page=pm&function=inbox&delete={$view->id}">{lang->getMsg p1='pm_view_delete'}</a>{/if}
		</td>
    </tr>
  </table>
{/if}

{if $function=='inbox'}
{if $inbox}
  <table class="pools">
    <tr><th class="pools2"></th><th class="pools2">{lang->getMsg p1='pm_inbox_by'}</th><th class="pools2">{lang->getMsg p1='pm_inbox_do'}</th></tr>
    {foreach from=$inbox item="msg"}
    <tr>
		<td class="pools4" valign="top"><b>{if $msg->is_read == 0}{lang->getMsg p1='pm_inbox_new'}: {/if}<a href="./index.php?page=pm&function=view&msg_id={$msg->id}">{$msg->title}</a></b></td>
		<td class="pools4" width="160" valign="top"><a href="./index.php?page=showmember&showmember={$msg->sender->id}">{$msg->sender->name}</a><br>
		<b>{$msg->getDate()}</b>
      </td>
		<td class="pools4" width="115" valign="top"><a href="./index.php?page=pm&function=inbox&delete={$msg->id}">{lang->getMsg p1='pm_inbox_delete'}</a>
		{if $msg->is_read == 0}<br>
		<a href="./index.php?page=pm&function=inbox&markread={$msg->id}">{lang->getMsg p1='pm_inbox_markread'}</a>{/if}</td>
    </tr>
    {/foreach}
  </table>
{else}
{lang->getMsg p1='pm_inbox_nomsgs'}
{/if}
{/if}

{if $function=='sent'}
{if $sent}
  <table class="pools">
    <tr><th class="pools2"></th><th class="pools2">{lang->getMsg p1='pm_sent_to'}</th></tr>
    {foreach from=$sent item="msg"}
    <tr>
		<td class="pools4" valign="top"><b><a href="./index.php?page=pm&function=view&msg_id={$msg->id}">{$msg->title}</a></b></td>
		<td class="pools4" width="160" valign="top"><a href="./index.php?page=showmember&showmember={$msg->recipient->id}">{$msg->recipient->name}</a><br>
		<b>{$msg->getDate()}</b>
      </td>
    </tr>
    {/foreach}
  </table>
{else}
{lang->getMsg p1='pm_sent_nomsgs'}
{/if}
{/if}

{if $function=='new'}
{if $recipient}
  <table border="0">
<tr><td class="forms6">{lang->getMsg p1='pm_new_recipient'}:</td><td>{$recipient->name}</td>
</tr></table>
  {$msgform}
{else}
{if $adressbook}
  <table class="pools">
{foreach from=$adressbook item="adress"}
<tr><td width="200">
<a href="./index.php?page=showmember&showmember={$adress->recipient->id}">{$adress->recipient->name}</a>
</td><td>
(<a href="./index.php?page=pm&function=new&recipient={$adress->recipient->id}">{lang->getMsg p1='pm_new_writelink'}</a> |
<a href="./index.php?page=pm&function=new&delete={$adress->recipient->id}">{lang->getMsg p1='pm_new_deletecontactlink'}</a>)
</td></tr>
{/foreach}
  </table>
{else}
{lang->getMsg p1='pm_new_empty'}
{/if}
{/if}
{/if}

{include file="footer.tpl"}