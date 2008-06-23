{include file="./header.tpl"}

<div id="content2">
<a href="./index.php?page=showpool&pool_id={$user_new_pool->id}">&laquo; {lang->getMsg p1='freeres_back'}</a><br><br>

<form action="./index.php?page=freeres&pool_id={$user_new_pool->id}" method="post">
<input type="hidden" name="refer" value="{$refer}">
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
		<td class="pools"><input type="checkbox" value="check" name="{$res->id}"
		{if $res->isPool($user_new_pool->id)}checked="checked"{/if}></td>
		<td class="pools">{$res->getCatFormat()}</td>
		<td class="pools"><b>{$res->name}</b><br>{$res->description}</td>
		<td class="pools">{$res->getSinceFormat()}</td>
		<td class="pools">{$res->getTypeFormat()}</td>
  </tr>
  {/foreach}
</table>
<img src="./images/arrow.png"> <input type="submit" name="res_free_submit" value="{lang->getMsg p1='mysite_freeres_button_submit-1'}"> | <input type="submit" name="no_free_submit" value="{if $new_pool}{lang->getMsg p1='mysite_freeres_button_clear'}{else}{lang->getMsg p1='freeres_clear_old'}{/if}"> |
{if $refer=="mysite"}
<a href="./index.php?page=mysite&pool_id={$user_new_pool->id}">{lang->getMsg p1='freeres_cancel'}</a></form><br />
{else}
<a href="./index.php?page=showpool&pool_id={$user_new_pool->id}">{lang->getMsg p1='freeres_cancel'}</a></form><br />
{/if}

{include file="./footer.tpl"}