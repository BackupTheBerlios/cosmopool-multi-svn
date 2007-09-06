{include file="header.tpl"}
<div id="resnavi"><div id="resnavi9">
  {if $pool}
    <a href="index.php?page=showpool&pool_id={$pool->id}">{$pool->name}</a> -> 
  {/if}
  {foreach from=$hierarchie item="cat"}
    <a href="./index.php?page=resbrowser&cat={$cat.id}{$get_add_cat}">{$cat.name}</a> -> 
  {/foreach}
  <b>{$act_cat}</b>
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
</div></div>
<div id="resnavi32">
{if $cats}
<div class="resnavi4"><b>{lang->getMsg p1='resbrowser_refinesearch_header'}</b></div>
<div class="resnavi5"><br>

    
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
<div class="resnavi4"><b>Suchoptionen</b>
</div>
<div class="resnavi5">

{foreach from=$attributes item="attr"}
<br>{assign var='id' value=$attr->id}
<b>{$attr->getName()}:</b>
<br><input name="attribute{$attr->id}" value="{$attribute_presets.$id}" type="text" size="17" class="inputtext2">
{/foreach} 
<br><br><input type="submit" class="inputsubmit2" value="{lang->getMsg p1='search_form_submit'}">
</div>
{/if}
</div>
</form>
  <div id="content2">

<form action="./index.php?page=resbrowser{$get_add}" method="POST">
<input type="hidden" name="show_page" value="{$act_page}">
{$restable}
</form>
<p class="standard">{lang->getMsg p1='resbrowser_page'}
{foreach from=$res_count item="c"}
{if $c==$act_page}
<b>{$c}</b>
{else}
<a href="./index.php?page=resbrowser&cat={$act_cat_id}{$get_add_cat}&show_page={$c}">{$c}</a>
{/if}
{/foreach}</p>	
{include file="footer.tpl"}