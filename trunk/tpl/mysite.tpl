{include file="./header.tpl"}

  <div id="content4">
<div class="content4header">{lang->getMsg p1='mysite_mypools_header'}</div><br>
<div id="content4links">
{foreach from=$mypoolstable item="pool"}
<img src="./images/linklist_dot.png"> <a href="./index.php?page=showpool&pool_id={$pool.id}">{$pool.name}</a><br>
{/foreach}<br>
<a href="index.php?page=poolbrowser&function=public">{lang->getMsg p1='mysite_links_poolbrowser_name'}</a>
  </div></div><div id="content3">

{if $new_pool}
<div class="supermsg">{lang->getMsg p1='mysite_freeres_msg-1'}
"{$new_pool->name}"
{lang->getMsg p1='mysite_freeres_msg-2'}<br><br>
{lang->getMsg p1='mysite_freeres_msg-3'}: 
<a href="./index.php?page=freeres&pool_id={$new_pool->id}&refer=mysite">{lang->getMsg p1='mysite_freeres_msg-4'}</a> |
<a href="./index.php?page=mysite&function=freenone&freenone_pool_id={$new_pool->id}">{lang->getMsg p1='mysite_freeres_msg-5'}</a></div><br><br>
{/if}

{if $registered_msg == true}
<div class="supermsg">{lang->getMsg p1='mysite_registered'}<br><br>
[<a href="./index.php?page=userdata&">{lang->getMsg p1='mysite_registered_link_userdata'}</a> | <a href="./index.php?page=mysite&function=noregistered&">{lang->getMsg p1='mysite_registered_link_nomore'}</a>]</div><br><br>
{/if}

{if $welcome_msg == true}
<div class="welcomemsg">{lang->getMsg p1='mysite_welcome'}<br><br>
[<a href="./index.php?page=mysite&function=nowelcome&">{lang->getMsg p1='mysite_nowelcome'}</a>]</div><br><br>
{/if}

<table class="pools">
  <tr>
	<th class="pools">{lang->getMsg p1='mysite_res_header'}</th>
	<th class="pools" width=25>&nbsp;</th>
	<th class="pools">{lang->getMsg p1='mysite_userdata_header'}</th>
  </tr>
  <tr>
	<td class="pools1">
     <img src="./images/linklist_dot.png"> <a href="index.php?page=resmanager">{lang->getMsg p1='mysite_links_resmanager_name'}</a><br>
     <img src="./images/linklist_dot.png"> <a href="index.php?page=resdata">{lang->getMsg p1='mysite_links_resdata_name'}</a><br>
	</td>

	<td class="pools1"></td>

	<td class="pools1">
     <img src="./images/linklist_dot.png"> <a href="index.php?page=userdata&function=data">{lang->getMsg p1='mysite_links_userdata_name'}</a><br>
     <img src="./images/linklist_dot.png"> <a href="index.php?page=userdata&function=password">{lang->getMsg p1='mysite_links_userdatapassword_name'}</a><br>
     <img src="./images/linklist_dot.png"> <a href="index.php?page=userdata&function=photos">{lang->getMsg p1='mysite_links_photos'}</a><br>
	</td>
  </tr>

{if $borrowed}
  <tr>
	<td class="pools2">&nbsp;</td><td class="poolsblank"></td><td class="poolsblank"></td>
  </tr>
  <tr>
	<td class="pools1" colspan="3">
     <b>{lang->getMsg p1='mysite_borrowed_header'}: </b> 
  {foreach from=$borrowed key="key" item="res"}{if $key != 0}, {/if}"{$res->name}" {lang->getMsg p1='mysite_by'} <a href="./index.php?page=showmember&showmember={$res->user->id}">{$res->user->name}</a>{/foreach}
	</td>
  </tr>
{/if}
	
</table>
<br>{lang->getMsg p1='mysite_fun'}


{include file="./footer.tpl"}