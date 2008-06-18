{include file="header.tpl"}
<div id="subnavi">
  <a href="javascript:window.back()" class="subnavi_linkclosed">{lang->getMsg p1='showmember_back'}</a><span class="subnavi_linkclosed"></span>
</div>

  <div id="content2">
 
{if $photo}
<div class="memberdiv1">
<div class="photo3"><a class="picture"
 href="./index.php?page=showpicture&id={$photo->name}" target="ueber" onclick="javascript: window.open(this,'ueber','width=432,height={$photo->getHeight()},scrollbars=yes');"><img
  src="./images/uploads/thumb_{$photo->name}" class="photo"></a></div>
</div>
{/if}

<div{if $photo} class="memberdiv2"{/if}>
<table class=pooldesc>{if $member.obj->plz_city_public}
<tr>
  <td class=pooldesc1>{lang->getMsg p1='showmember_adress'}: </td>
  <td class=pooldesc2>
{$member.obj->street} {$member.obj->house}
<br>{$member.obj->plz} {$member.obj->city}<br>
{$member.obj->getCountry()}
</td>
</tr>
<tr>{/if}{if $member.obj->email_public}
  <td class=pooldesc1>{lang->getMsg p1='showmember_email'}: </td>
  <td class=pooldesc2>
{$member.obj->email}
</td>
</tr>
<tr>{/if}{if $member.obj->phone_public}
  <td class=pooldesc1>{lang->getMsg p1='showmember_phone'}: </td>
  <td class=pooldesc2>
{if $member.obj->phone}
{$member.obj->phone}
{/if}
</td>
</tr>{/if}{if $member.obj->description}
<tr>
  <td class=pooldesc1>{lang->getMsg p1='showmember_description'}: </td>
  <td class=pooldesc2>{$member.obj->description}
</td>
</tr>{/if}
<tr>
  <td class=pooldesc1>{lang->getMsg p1='showmember_distance'}: </td>
  <td class=pooldesc2>{if $geodist == 'userfalse'}{lang->getMsg p1='showmember_userfalse'}{else}{if $geodist == 'memberfalse'}{lang->getMsg p1='showmember_memberfalse'}{else}{$geodist} km{/if}{/if}
</td>
</tr>
</table><br><a href="./index.php?page=pm&function=new&recipient={$member.obj->id}">{lang->getMsg p1='showmember_msglink'}</a> |
<a href="./index.php?page=showmember&showmember={$member.obj->id}&add_to_adressbook=1">{lang->getMsg p1='showmember_adressbooklink'}</a>
</div>

{include file="footer.tpl"}
