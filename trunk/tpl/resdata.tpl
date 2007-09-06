{include file="header.tpl" javascript=true}
<div id="subnavi">
  <a href="./index.php?page=resmanager&function=all" class="subnavi_linkclosed">{lang->getMsg p1='resdata_all_header'}</a><span class="subnavi_linkclosed"></span>
</div>
  <div id="content2">

{$form}
{if $new_res_link == true}
<p class="standard"><a href="./index.php?page=resdata&cat={$cat}">{lang->getMsg p1='resdata_link1'}</a> | <a href="./index.php?page=resmanager">{lang->getMsg p1='resdata_link2'}</a></p>
{/if}

{include file="footer.tpl"}