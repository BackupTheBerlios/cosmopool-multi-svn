{include file="header.tpl"}
  <div id="content2">

{if $admins}
<p class="standard"><b>{lang->getMsg p1='pooladmin_adminlist_header'}</b>: 
{foreach from=$admins item="member"}
{if $member.detail}
{if $member.count != 1}
</p><p class="standard">
{/if}
<b>{$member.obj->name}</b><br>
{$member.obj->street} {$member.obj->house}<br>
{$member.obj->plz} {$member.obj->city}<br>
{$member.obj->email}<br>
{$member.obj->phone}
</p><p class="standard">
{else}
<a href="./index.php?page=pooladmin&pool_id={$pool->id}&showadmin={$member.obj->id}">{$member.obj->name}</a>
{/if}
{/foreach}
</p>
{/if}

{if $members}
<p class="standard"><b>{lang->getMsg p1='pooladmin_memberlist_header'}</b>: 
{foreach from=$members item="member"}
{if $member.detail}
{if $member.count != 1}
</p><p class="standard">
{/if}
<b>{$member.obj->name}</b><br>
{$member.obj->street} {$member.obj->house}<br>
{$member.obj->plz} {$member.obj->city}<br>
{$member.obj->email}<br>
{$member.obj->phone}
</p><p class="standard">
{else}
<a href="./index.php?page=pooladmin&pool_id={$pool->id}&showmember={$member.obj->id}">{$member.obj->name}</a>
{/if}
{/foreach}
</p>
{/if}

{if $new_admins}
<p class="headline2" id="anzeigen">{lang->getMsg p1='pooladmin_addadmins_header'}</p>
{if $really_add_admin}
<p class="standard">{lang->getMsg p1='pooladmin_addadmins_reallyadd_text-1'}{$really_add_admin->name}{lang->getMsg p1='pooladmin_addadmins_reallyadd_text-2'}<a href="./index.php?page=pooladmin&action=new_admin&user={$really_add_admin->id}&pool_id={$pool->id}&really=yes">{lang->getMsg p1='pooladmin_addadmins_reallyadd_yes'}</a> | <a href="./index.php?page=pooladmin&pool_id={$pool->id}">{lang->getMsg p1='pooladmin_addadmins_reallyadd_no'}</a></p>
{/if}
<p class="standard">
{foreach from=$new_admins item="admin"}
  <a href="./index.php?page=pooladmin&action=new_admin&user={$admin->id}&pool_id={$pool->id}">{$admin->name}</a>
{/foreach}
</p>
{/if}

{if $kick_user}
<p class="headline2" id="anzeigen">{lang->getMsg p1='pooladmin_kickmember_header'}</p>
{if $really_kick_member}
<p class="standard">{lang->getMsg p1='pooladmin_kickmember_reallykick_text-1'}{$really_kick_member->name}{lang->getMsg p1='pooladmin_kickmember_reallykick_text-2'}<a href="./index.php?page=pooladmin&action=kick_user&user={$really_kick_member->id}&pool_id={$pool->id}&really=yes">{lang->getMsg p1='pooladmin_kickmember_reallykick_yes'}</a> | <a href="./index.php?page=pooladmin&pool_id={$pool->id}">{lang->getMsg p1='pooladmin_kickmember_reallykick_no'}</a></p>
{/if}
<p class="standard">
{foreach from=$kick_user item="user"}
  <a href="./index.php?page=pooladmin&action=kick_user&user={$user->id}&pool_id={$pool->id}">{$user->name}</a>
{/foreach}
</p>
{/if}

{if $waiting_user}
<p class="headline2" id="anzeigen">{lang->getMsg p1='pooladmin_freemembers_header'}</p>
<form action="./index.php?page=pooladmin&pool_id={$pool->id}" method="post">

  <table width="100%" class="pools">
  	 <tr>
 		 <th class="pools"> </th>
		 <th class="pools">{lang->getMsg p1='pooladmin_freemembers_tableheader_name'}</th>
		 <th class="pools">{lang->getMsg p1='pooladmin_freemembers_tableheader_adress'}</th>
		 <th class="pools">{lang->getMsg p1='pooladmin_freemembers_tableheader_email'}</th>
	 	 <th class="pools">{lang->getMsg p1='pooladmin_freemembers_tableheader_phone'}</th>
	 	 <th class="pools">{lang->getMsg p1='pooladmin_freemembers_tableheader_comment'}</th>
	 </tr>
	 {foreach from=$waiting_user item="user"}
  	 <tr>
 		 <td class="pools"><input type="checkbox" value="1" name="{$user.obj->id}"></td>
		 <td class="pools">{$user.obj->name}</td>
		 <td class="pools">{$user.obj->street} {$user.obj->house}<br>{$user.obj->plz} {$user.obj->city}</td>
		 <td class="pools">{$user.obj->email}</td>
	 	 <td class="pools">
       {if $user.obj->phone_public}
                {$user.obj->phone}
       {else}
                {lang->getMsg p1='pooladmin_freemembers_table_phonenotpublic'}
       {/if}
       </td>
	   <td class="pools">{$user.comments}</td>
	 </tr>
	 {/foreach}
  </table>

  <img src="./images/arrow.png"> 
  <input type="submit" name="user_accept_submit" value="{lang->getMsg p1='pooladmin_freemembers_table_submit'}"> / 
  <input type="submit" name="user_refuse_submit" value="{lang->getMsg p1='pooladmin_freemembers_table_clear'}">
</form>
{/if}

<p class="headline2" id="anzeigen">{lang->getMsg p1='pooladmin_delpool_header'} <font class="help">[<a href="./index.php?page=help#3">{lang->getMsg p1='common_help_link'}</a>]</font></p>
{if $lastadmin}

{if $reallydelpool}
<p class="standard">{lang->getMsg p1='pooladmin_delpool_reallydel_text-1'}
  <a href="index.php?page=pooladmin&pool_id={$pool->id}&action=delpool&really=yes">{lang->getMsg p1='pooladmin_delpool_reallydel_yes'}</a> | 
  <a href="./index.php?page=pooladmin&pool_id={$pool->id}">{lang->getMsg p1='pooladmin_delpool_reallydel_no'}</a>
</p>
{else}
<p class="standard"><a href="index.php?page=pooladmin&pool_id={$pool->id}&action=delpool">{lang->getMsg p1='pooladmin_delpool_link'}</a></p>
{/if}

{else}
<p class="standard">Nicht m&ouml;glich, siehe <a href="./index.php?page=help#3">{lang->getMsg p1='common_help_link'}</a>.</p>
{/if} 

{include file="footer.tpl"}