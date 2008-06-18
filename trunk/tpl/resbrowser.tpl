{include file="header.tpl"}
<div id="resnavi">
{if $resdata}
{else}
<div id="resnavi9">
{/if}
  {if $pool}
    <a href="index.php?page=showpool&pool_id={$pool->id}">{$pool->name}</a> -> 
  {/if}
  {foreach from=$hierarchie item="cat"}
    <a href="./index.php?page=resbrowser&cat={$cat.id}{$get_add_cat}">{$cat.name}</a> -> 
  {/foreach}
{if $resdata}
  <b>{$resdata.name}</b>
{else}
  <b>{$act_cat}</b>
{/if}
<form action="./index.php?page=resbrowser&cat={$act_cat_id}{$get_add_cat}" method="post">
<br><input name="searchstring" value="{$searchstring}" type="text" size="17" class="inputtext2"> in 
<select name="searchwhere" class="inputtext">
<option value="{$pools_get}">{lang->getMsg p1='search_option_all_pools'}</option>
{foreach from=$pools item="userpool"}
<option {if $searchwhere == $userpool.0}selected="selected"{/if} value="{$userpool.0}">{$userpool.1}</option>
{/foreach}
</select>
<input type="hidden" name="action" value="search">
<input type="submit" class="inputsubmit2" value="{lang->getMsg p1='search_form_submit'}">
{if $resdata}
{else}
</div>
{/if}
</div>
{if $resdata}
{else}
<div id="resnavi32">{if $cats}<div class="resnavi42"><b>{lang->getMsg p1='resbrowser_refinesearch_header'}</b></div>
<div class="resnavi5">

    
    {foreach from=$cats key="number" item="cat"}
    <a href="./index.php?page=resbrowser&cat={$cat.id}{$get_add_cat}">{$cat.name}</a>({$cat.count})
    {if $number == 0}
    <div class="subcats">
    {foreach from=$lowercats item="lowercat"}
    &nbsp;&nbsp;&nbsp;<a href="./index.php?page=resbrowser&cat={$lowercat.id}{$get_add_cat}">{$lowercat.name}</a>({$lowercat.count})<br>
    {/foreach}
    </div>
    {else}
    <br>
    {/if}
    {/foreach}	
<br><br></div>
{/if}
{if $attributes}
<div class="resnavi42"><b>Suchoptionen</b>
</div>
<div class="resnavi5">

{foreach from=$attributes item="attr"}
{assign var='id' value=$attr->id}
<b>{$attr->getName()}:</b>
<br><input name="attribute{$attr->id}" value="{$attribute_presets.$id}" type="text" size="17" class="inputtext2">
<br>{/foreach} 
<br><input type="submit" class="inputsubmit2" value="{lang->getMsg p1='search_form_submit'}">
</div>
{/if}
</div>
{/if}
</form>
<form action="./index.php?page=resbrowser{$get_add}" method="POST">
  <div id="content2">
{if $resdata}
  <a href="./index.php?page=resbrowser&cat={$act_cat_id}&searchstring={$searchstring}&searchwhere={$searchwhere}&show_page={$act_page}">&laquo; {lang->getMsg p1='resbrowser_backtolist'}</a><br><br>
<table class="res">
	<tr>
		<td class="pools3" colspan="3">
      <b>{$resdata.name}</b>
	   <br>{$resdata.description}
	   {foreach from=$resdata.attributes item="attr"}
	     <br><b>{lang->getMsg p1=$attr.name}: </b> {$attr.value}
	   {/foreach}

	    <br><br>{lang->getMsg p1='resbrowser_owner'} <a href="./index.php?page=showmember&showmember={$resdata.user_id}">{$resdata.user_name}</a>.
	    <br><br><b>{lang->getMsg p1='tables_contactdata'}</b><br>
	    {if $resdata.own_ressource}
		   {lang->getMsg p1='tables_contactdata_youdontneed'}
	    {else}
	  {if $one_public}

	                {$resdata.user_name}
	                
	                {if $resdata.user_plz_city_public}
	                <br>{$resdata.user_street} {$resdata.user_house}<br>
	                {$resdata.user_plz} {$resdata.user_city}{/if}
	                
	                {if $resdata.user_email_public}
	                <br>{$resdata.user_email}{/if}
	                
	                {if $resdata.user_phone_public}
	                {if $resdata.user_phone}<br>
	                {$resdata.user_phone}{/if}{/if}
	  {else}
		 {lang->getMsg p1='tables_contactdata_isinvisible'}
		 {/if}
	  {/if}

{if $resdata.own_ressource}{else}
	  {if $resdata.available}
	    {if $resdata.is_waiting}
	      <br><br><font class="msg">{lang->getMsg p1='tables_request_running'}</font>
	    {else}
         <br><br><b>{lang->getMsg p1='tables_comment_for_the_owner'}: </b><br>
	         <input type="hidden" name="id" value="{$resdata.res_id}">
			   <textarea name="comments" cols="30" rows="5"></textarea><br>
	         <input type="submit" name="submit" value="{$resdata.resolvetype}">
	    {/if}
	  {else}
	    <br><br><font class="msg">{lang->getMsg p1='tables_allready_borrowed'}</font>
	  {/if}
{/if}
    </td>
  </tr>
</table>
{else}
{$restable}
<p class="standard">{lang->getMsg p1='resbrowser_page'}
{foreach from=$res_count item="c"}
{if $c==$act_page}
<b>{$c}</b>
{else}
<a href="./index.php?page=resbrowser&cat={$act_cat_id}{$get_add_cat}&show_page={$c}">{$c}</a>
{/if}
{/foreach}</p>	
{/if}
<input type="hidden" name="show_page" value="{$act_page}">
<input type="hidden" name="res_id" value="{$resdata.res_id}">
</form>
{include file="footer.tpl"}