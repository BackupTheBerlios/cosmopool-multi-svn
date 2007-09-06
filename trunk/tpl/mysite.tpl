{include file="./header.tpl"}

  <span id="content4">
<div class="content4header">{lang->getMsg p1='mysite_mypools_header'}</div><br>
{foreach from=$mypoolstable item="pool"}
<img src="./images/linklist_dot.png"> <a href="./index.php?page=showpool&pool_id={$pool.id}">{$pool.name}</a><br>
{/foreach}<br>
<a href="index.php?page=poolbrowser&pools=all">{lang->getMsg p1='mysite_links_poolbrowser_name'}</a>
  </span><div id="content3">

{if $userres}
<p class="headline2">{lang->getMsg p1='mysite_freeres_header-1'}{$user_new_pool->name}{lang->getMsg p1='mysite_freeres_header-2'}</p>
<p class="msg">{lang->getMsg p1='mysite_freeres_msg-1'}{$user_new_pool->name}{lang->getMsg p1='mysite_freeres_msg-2'}</p>
<form action="./index.php?page=mysite&pool={$user_new_pool->id}" method="post">
<table class="pools">
	<tr>
		<th class="pools"> </th>
		<th class="pools">{lang->getMsg p1='mysite_freerestable_header_category'}</th>
		<th class="pools">{lang->getMsg p1='mysite_freerestable_header_name_description'}</th>
		<th class="pools">{lang->getMsg p1='mysite_freerestable_header_since'}</th>
		<th class="pools">{lang->getMsg p1='mysite_freerestable_header_type'}</th>
	</tr>

   {foreach from=$userres item="res"}
	<tr>
		<td class="pools"><input type="checkbox" value="check" name="{$res->id}"></td>
		<td class="pools">{$res->getCatFormat()}</td>
		<td class="pools"><b>{$res->name}</b><br>{$res->description}</td>
		<td class="pools">{$res->getSinceFormat()}</td>
		<td class="pools">{$res->getTypeFormat()}</td>
  </tr>
  {/foreach}
</table>
<img src="./images/arrow.png"> <input type="submit" name="res_free_submit" value="{lang->getMsg p1='mysite_freeres_button_submit-1'}{$user_new_pool->name}{lang->getMsg p1='mysite_freeres_button_submit-2'}"> | <input type="submit" name="no_free_submit" value="{lang->getMsg p1='mysite_freeres_button_clear'}"></form><br />
{else}
{lang->getMsg p1='mysite_welcome'}<br><br>

{/if}


<table class="pools">
  <tr>
	<th class="pools">{lang->getMsg p1='mysite_res_header'}</th>
	<th class="pools" width=25>&nbsp;</th>
	<th class="pools">{lang->getMsg p1='mysite_userdata_header'}</th>
	<th class="pools" width=25>&nbsp;</th>
	<th class="pools">{lang->getMsg p1='mysite_searchres_header'}</th>
  </tr>
  <tr>
	<td class="pools1">
     <img src="./images/linklist_dot.png"> <a href="index.php?page=resmanager">{lang->getMsg p1='mysite_links_resmanager_name'}</a><br>
     <img src="./images/linklist_dot.png"> <a href="index.php?page=resdata">{lang->getMsg p1='mysite_links_resdata_name'}</a><br>
	</td>

	<td class="pools1"></td>

	<td class="pools1">
     <img src="./images/linklist_dot.png"> <a href="index.php?page=userdata">{lang->getMsg p1='mysite_links_userdata_name'}</a><br>
     <img src="./images/linklist_dot.png"> <a href="index.php?page=userdatapassword">{lang->getMsg p1='mysite_links_userdatapassword_name'}</a><br>
	</td>
	<td class="pools1"></td>

	<td class="pools1">
     <img src="./images/linklist_dot.png"> <a href="index.php?page=search">{lang->getMsg p1='mysite_links_search_name'}</a><br>
	</td>
  </tr>

{if $borrowed}
  <tr>
	<td class="pools2">&nbsp;</td><td class="poolsblank"></td><td class="poolsblank"></td><td class="poolsblank"></td><td class="poolsblank"></td>
  </tr>
  <tr>
	<td class="pools1" colspan="5">
     <b>{lang->getMsg p1='mysite_borrowed_header'}: </b> 
  {foreach from=$borrowed key="key" item="res"}{if $key != 0}, {/if}"{$res->name}" von {$res->user->name}{/foreach}
	</td>
  </tr>
{/if}
	
</table>
<br>{lang->getMsg p1='mysite_fun'}



{include file="./footer.tpl"}