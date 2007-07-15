{include file="header.tpl"}

  {if $pool}
    <a href="./index.php?page=showpool&pool_id={$pool->id}">{$pool->name}</a> -> 
  {/if}

{if $form}
  <a href="./index.php?page=threadbrowser&pool_id={$pool->id}&thread={$thread->id}">{$thread->title}</a> ->
  {lang->getMsg p1='threadbrowser_newentry_hier'}
  <br><br>{$form}<br>

{else}
  <b>{$thread->title}</b><br><br>
{/if}

{if $entries}
<table class="pools">

{foreach from=$entries key="entry_id" item="entry"}
<tr><td class="pools">{$entry->text}
</tr></td>
<tr><td class="pools"><b>{$entry->getDateFormat()}</b> {lang->getMsg p1='threadbrowser_by'}
<a href="./index.php?page=showmember&pool_id={$pool->id}&showmember={$entry->user_id}" target="ueber" onclick="javascript: window.open(this,'ueber','width=350,height=300,scrollbars=yes');">{$entry->user->name}</a>
</tr></td>
<tr><td>&nbsp;
</tr></td>
{/foreach}
<tr><td class="pools" align="right"><a href="./index.php?page=threadbrowser&pool_id={$pool->id}&thread={$thread->id}&action=new_entry">{lang->getMsg p1='threadbrowser_newentry_link'}</a>
</tr></td>

</table>
{/if}


{include file="footer.tpl"}