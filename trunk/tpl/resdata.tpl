{include file="header.tpl" javascript=true}

{$form}
{if $new_res_link == true}
<p class="standard"><a href="./index.php?page=resdata&cat={$cat}">{lang->getMsg p1='resdata_link1'}</a> | <a href="./index.php?page=resmanager">{lang->getMsg p1='resdata_link2'}</a></p>
{/if}

{include file="footer.tpl"}