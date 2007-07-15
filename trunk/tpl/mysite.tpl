{include file="./header.tpl"}

{if $userres}
<p class="headline2">{lang->getMsg p1='mysite_freeres_header-1'}{$user_new_pool->name}{lang->getMsg p1='mysite_freeres_header-2'}</p>
<p class="msg">{lang->getMsg p1='mysite_freeres_msg-1'}{$user_new_pool->name}{lang->getMsg p1='mysite_freeres_msg-2'}</p>
<form action="./index.php?page=mysite&pool={$user_new_pool->id}" method="post">
<table width="100%" class="pools">
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


<table width="100%" class="pools">
  <tr>
	<th class="pools">{lang->getMsg p1='mysite_res_header'}</th>
	<th class="poolsblank" width=25>&nbsp;</th>
	<th class="pools">{lang->getMsg p1='mysite_userdata_header'}</th>
	<th class="poolsblank" width=25>&nbsp;</th>
	<th class="pools">{lang->getMsg p1='mysite_searchres_header'}</th>
  </tr>
  <tr>
	<td class="pools">
     <img src="./images/linklist_dot.png"> <a href="index.php?page=resmanager">{lang->getMsg p1='mysite_links_resmanager_name'}</a><br>
     <img src="./images/linklist_dot.png"> <a href="index.php?page=resdata">{lang->getMsg p1='mysite_links_resdata_name'}</a><br>
	</td>

	<td class="poolsblank"></td>

	<td class="pools">
     <img src="./images/linklist_dot.png"> <a href="index.php?page=userdata">{lang->getMsg p1='mysite_links_userdata_name'}</a><br>
     <img src="./images/linklist_dot.png"> <a href="index.php?page=userdatapassword">{lang->getMsg p1='mysite_links_userdatapassword_name'}</a><br>
	</td>
	<td class="poolsblank"></td>

	<td class="pools">
     <img src="./images/linklist_dot.png"> <a href="index.php?page=search">{lang->getMsg p1='mysite_links_search_name'}</a><br>
	</td>
  </tr>

{if $borrowed}
  <tr>
	<td class="poolsblank">&nbsp;</td><td class="poolsblank"></td><td class="poolsblank"></td><td class="poolsblank"></td><td class="poolsblank"></td>
  </tr>
  <tr>
	<td class="pools" colspan="5">
     <b>{lang->getMsg p1='mysite_borrowed_header'}: </b> 
  {foreach from=$borrowed key="key" item="res"}{if $key != 0}, {/if}"{$res->name}" von {$res->user->name}{/foreach}
	</td>
  </tr>
{/if}
	
</table>


<p class="headline2">{lang->getMsg p1='mysite_mypools_header'}</p>
<table width="100%" class="pools">
  <tr>
	 <th class="pools">{lang->getMsg p1='tableheaders_name'}</th>
	 <th class="pools">{lang->getMsg p1='tableheaders_area'}</th>

    {if $mypoolstable_thirdcol}
	 <th class="pools" width="300"> </th>
	 {/if}

  </tr>
  {foreach from=$mypoolstable item="pool"}
  <tr>
	 <td class="pools">
	   <a href="./index.php?page=showpool&pool_id={$pool.id}&cat=0&type=0">{$pool.name}</a>
	 </td>
	 <td class="pools">{$pool.area}</td>

    {if $mypoolstable_thirdcol}
	 <td class="pools">{$pool.links}</td>
	 {/if}
	 
  </tr>
  {if $pool.name == 'Pool'}
  <tr>
	 <td color="white" colspan="2">&nbsp;</td>

    {if $mypoolstable_thirdcol}
	 <td color="white"> </td>
	 {/if}
	 
  </tr>

  {/if}
  {/foreach}
  <tr>
    {if $mypoolstable_thirdcol}
    <td class="poolsblank" colspan=3>&nbsp; </td>
    {else}
    <td class="poolsblank" colspan=2>&nbsp; </td>
    {/if}
  </tr>
  <tr>
    {if $mypoolstable_thirdcol}
    <td class="pools" colspan=3>
    {else}
    <td class="pools" colspan=2>
    {/if}
      <a href="index.php?page=poolbrowser&pools=all">{lang->getMsg p1='mysite_links_poolbrowser_name'}</a> |
      <a href="index.php?page=pooldata">{lang->getMsg p1='mysite_links_pooldata_name'}</a>
    </td>
  </tr>
</table>


{include file="./footer.tpl"}