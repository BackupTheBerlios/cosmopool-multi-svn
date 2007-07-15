{include file="header.tpl"}

  {if $pool}
    <a href="index.php?page=showpool&pool_id={$pool->id}">{$pool->name}</a> -> 
  {/if}
  {foreach from=$hierarchie item="cat"}
    <a href="./index.php?page=resbrowser&cat={$cat.id}{$get_add_cat}">{$cat.name}</a> -> 
  {/foreach}
  <b>{$act_cat}</b>
<br><br>
{if $cats}
    {lang->getMsg p1='resbrowser_refinesearch_header'}
    {foreach from=$cats key="cat_id" item="cat"}
    <a href="./index.php?page=resbrowser&cat={$cat_id}{$get_add_cat}">{$cat.name}</a>({$cat.count})
    {/foreach}
<br><br>
{/if}
<form action="./index.php?page=resbrowser{$get_add}" method="POST">
<input type="hidden" name="show_page" value="{$act_page}">
{$restable}
</form>
<p class="standard">{lang->getMsg p1='resbrowser_page'}: 
{foreach from=$res_count item="c"}
{if $c==$act_page}
<b>{$c}</b>
{else}
<a href="./index.php?page=resbrowser&cat={$act_cat_id}{$get_add_cat}&show_page={$c}">{$c}</a>
{/if}
{/foreach}</p>	
{include file="footer.tpl"}