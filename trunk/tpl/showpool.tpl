{include file="header.tpl"}
{if $form}
  <a href="./index.php?page=showpool&pool_id={$pool->id}">{$pool->name}</a> ->
  {lang->getMsg p1='showpool_forum_new_thread'}
  <br><br>{$form}<br>

{else}
{if $pool}
{$pool->getDescription()}



{if $cats}
<p class="headline2">{lang->getMsg p1='showpool_res_header'}</p>
<table class="pools">
  <tr>
    <th class="pools">
      {lang->getMsg p1='showpool_res_category'}
    </th>
    <th class="pools" width="50">
      {lang->getMsg p1='showpool_res_goods'}
    </th>
  </tr>

  {foreach from=$cats key="cat_id" item="cat"}
    <tr>
      <td class="pools">
        <a href="./index.php?page=resbrowser&pool_id={$pool->id}&cat={$cat_id}">{$cat.name}</a>
      </td>
      <td class="pools">
        {$cat.count}
      </td>
    </tr>
  {/foreach}
</table>
{/if}


<p class="headline2">{lang->getMsg p1='showpool_forum_header'}</p>
<table class="pools">
{if $threads}
  <tr>
    <th class="pools">
      {lang->getMsg p1='showpool_forum_thread'}
    </th>
    <th class="pools" width="250">
      {lang->getMsg p1='showpool_forum_lastentry'}
    </th>
  </tr>

  {foreach from=$threads key="thread_id" item="thread"}
    <tr>
      <td class="pools">
        <a href="./index.php?page=threadbrowser&pool_id={$pool->id}&thread={$thread.id}">{$thread.title}</a>
      </td>
      <td class="pools">
        {$thread.act_date}
      </td>
    </tr>
  {/foreach}
{else}
<tr><td class="pools" align="center">--- keine Einträge ---</td></tr>
{/if}
<tr><td>&nbsp;</td></tr>
<tr><td colspan="2" class="pools" align="right"><a href="./index.php?page=showpool&pool_id={$pool->id}&action=new_entry">neuen Thread erstellen</a></td></tr>
</table>
{if $res_counter}
<p class="standard">{lang->getMsg p1='showpool_membercount_text-1'}{$res_counter}{lang->getMsg p1='showpool_membercount_text-2'}</p>
{/if}
{if $members}
<p class="headline2">{lang->getMsg p1='showpool_members_header'}</p>
<p class="standard">
{foreach from=$members item="member"}
{if $member.detail}
{if $member.count != 1}
</p><p class="standard">
{/if}
<b>{$member.obj->name}{if $member.admin}(Admin){/if}</b><br>
{$member.obj->street} {$member.obj->house}<br>
{$member.obj->plz} {$member.obj->city}<br>
{$member.obj->email}<br>
{$member.obj->phone}
</p><p class="standard">
{else}
 <a href="./index.php?page=showmember&pool_id={$pool->id}&showmember={$member.obj->id}" target="ueber" onclick="javascript: window.open(this,'ueber','width=350,height=300,scrollbars=yes');">{$member.obj->name}</a>{if $member.admin}(Admin) {/if}  
{/if}
{/foreach}
</p>
{/if}

<br>
{if $not_member}
{if $become_member_form}
<form action="./index.php?page=showpool&pool_id={$pool->id}&action=become_member" method="POST">
<p class="headline2">{lang->getMsg p1='showpool_become_member_header'}</p>
<p class="standard">{lang->getMsg p1='showpool_become_member_cancomment'}</p>
<textarea name="become_member_comments" cols="30" rows="5"></textarea><br>
<input type="submit" name="become_member_submit" value="{lang->getMsg p1='showpool_become_member_submit'}">
{else}{if $pool->is_public == 1}
<p class="standard"><a href="./index.php?page=showpool&pool_id={$pool->id}&action=become_member">{lang->getMsg p1='showpool_become_member_public_link'}</a></p>
{else}
<p class="standard"><a href="./index.php?page=showpool&pool_id={$pool->id}&action=become_member">{lang->getMsg p1='showpool_become_member_link'}</a></p>
{/if}
{/if}
{else}
{if $pool->id != 1}
{if $user_is_waiting}
<p class="msg">{lang->getMsg p1='showpool_become_member_msg_isproven'}</p>
{else}
<p class="standard"><a href="./index.php?page=showpool&pool_id={$pool->id}&action=no_member">{lang->getMsg p1='showpool_leavepool_link'}</a></p>
{/if}
{/if}
{/if}
{/if}
{/if}
{include file="footer.tpl"}