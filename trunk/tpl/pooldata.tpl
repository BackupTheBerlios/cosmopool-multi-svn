{include file="header.tpl"}

{if $found}
  {lang->getMsg p1='pooldata_text'}<br><br>
{/if}

{$form}
{if $change_success_link == true}
<p class="standard"><a href="./index.php?page=pooldata&pool_id={$pool->id}">{lang->getMsg p1='pooldata_link1'}</a>
 | <a href="./index.php?page=showpool&pool_id={$pool->id}">{lang->getMsg p1='pooldata_link2'}</a></p>
{/if}

{include file="footer.tpl"}