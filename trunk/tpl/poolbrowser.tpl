{include file="header.tpl"}
<div id="subnavi">
  {if $function=='public'}
  <span class="subnavi_linkactive">{lang->getMsg p1='poolbrowser_headers_public'}</span><a href="./index.php?page=poolbrowser&function=private" class="subnavi_linkclosed">{lang->getMsg p1='poolbrowser_headers_private'}</a><span class="subnavi_linkclosed"></span>
  {else}
  <a href="./index.php?page=poolbrowser&function=public" class="subnavi_linkclosed">{lang->getMsg p1='poolbrowser_headers_public'}</a><span class="subnavi_linkactive">{lang->getMsg p1='poolbrowser_headers_private'}</span><span class="subnavi_linkclosed"></span>
  {/if}
</div>
  <div id="content2">

{$poolstable}

{include file="footer.tpl"}