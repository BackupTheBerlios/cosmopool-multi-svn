{include file="header.tpl"}
<div id="subnavi">
  {if $function==data}<span class="subnavi_linkactive">{lang->getMsg p1='userdata_navi_data'}</span><a href="./index.php?page=userdata&function=password" class="subnavi_linkclosed">{lang->getMsg p1='userdata_navi_password'}</a><a href="./index.php?page=userdata&function=photos" class="subnavi_linkclosed">{lang->getMsg p1='userdata_navi_photos'}</a><span class="subnavi_linkclosed"></span>{/if}
  {if $function==password}<a href="./index.php?page=userdata&function=data" class="subnavi_linkclosed">{lang->getMsg p1='userdata_navi_data'}</a><span class="subnavi_linkactive">{lang->getMsg p1='userdata_navi_password'}</span><a href="./index.php?page=userdata&function=photos" class="subnavi_linkclosed">{lang->getMsg p1='userdata_navi_photos'}</a><span class="subnavi_linkclosed"></span>{/if}
  {if $function==photos}<a href="./index.php?page=userdata&function=data" class="subnavi_linkclosed">{lang->getMsg p1='userdata_navi_data'}</a><a href="./index.php?page=userdata&function=password" class="subnavi_linkclosed">{lang->getMsg p1='userdata_navi_password'}</a><span class="subnavi_linkactive">{lang->getMsg p1='userdata_navi_photos'}</span><span class="subnavi_linkclosed"></span>{/if}
</div>

{if $function==data}
  <div id="content2">
{$text}<br><br>
{$form}
{/if}
{if $function==password}
  <div id="content2">
{$text}<br><br>
{$form}
{/if}
{if $function==photos}
{if $photos}

  <div id="content5">
{$text}<br><br>
{foreach from=$photos item="photo"}
<div class="photo3"><a class="picture" href="./index.php?page=userdata&function=photos&setmain={$photo.id}"><img src="./images/uploads/thumb_{$photo.name}" 
{if $mainphoto == $photo.id}class="photo2"{else}class="photo"{/if}></a><br>
<a class="picture" href="./index.php?page=showpicture&id={$photo.obj->name}" target="ueber" onclick="javascript: window.open(this,'ueber','width=432,height={$photo.obj->getHeight()},scrollbars=yes');">{lang->getMsg p1='userdata_photos_big'}</a> |&nbsp; <a class="picture" href="./index.php?page=userdata&function=photos&delete={$photo.id}">{lang->getMsg p1='userdata_photos_delete'}</a></div>{/foreach}
</div><div id="subnavi2"></div>

{/if}
<div id="content2">

{$form}
{/if}

{include file="footer.tpl"}