{include file="header.tpl"}
<div id="subnavi">
  <a href="javascript:window.back()" class="subnavi_linkclosed">{lang->getMsg p1='showmember_back'}</a><span class="subnavi_linkclosed"></span>
</div>

  <div id="content2">
 
{if $photo}
<div class="photo3"><a class="picture"
 href="./index.php?page=showpicture&id={$photo->name}" target="ueber" onclick="javascript: window.open(this,'ueber','width=432,height={$photo->getHeight()},scrollbars=yes');"><img
  src="./images/uploads/thumb_{$photo->name}" class="photo"></a></div>
{/if}

{if $public}
{if $member.obj->plz_city_public}
{$member.obj->street} {$member.obj->house}
<br>{$member.obj->plz} {$member.obj->city}<br>
{/if}

{if $member.obj->email_public}
{$member.obj->email}
{/if}

{if $member.obj->phone_public}
{if $member.obj->phone}
<br>{$member.obj->phone}
{/if}
{/if}
{else}
{$member.obj->street} {$member.obj->house}
<br>{$member.obj->plz} {$member.obj->city}<br>
{$member.obj->email}
{if $member.obj->phone}
<br>{$member.obj->phone}
{/if}
{/if}

{if $member.obj->description}
<br><br><b>{lang->getMsg p1='resdata_form_description'}</b><br>{$member.obj->description}
{/if}

{include file="footer.tpl"}
