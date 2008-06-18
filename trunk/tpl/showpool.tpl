{include file="header.tpl"}

<div id="resnavi3">
{if $pool->id != 1}
  <div class="resnavi4"><b>{lang->getMsg p1='showpool_do'}</b></div>
  <div class="resnavi5">
  {if $not_member}
    {if $become_member_form}
    <form action="./index.php?page=showpool&pool_id={$pool->id}&action=become_member" method="POST">
    <p class="headline2">{lang->getMsg p1='showpool_become_member_header'}</p>
    <p class="standard">{lang->getMsg p1='showpool_become_member_cancomment'}</p>
    <textarea name="become_member_comments" cols="30" rows="5"></textarea><br>
    <input type="submit" name="become_member_submit" value="{lang->getMsg p1='showpool_become_member_submit'}">
    {else}
      {if $pool->is_public == 1}
    <p class="standard"><a href="./index.php?page=showpool&pool_id={$pool->id}&action=become_member">{lang->getMsg p1='showpool_become_member_public_link'}</a></p>
      {else}
    <p class="standard"><a href="./index.php?page=showpool&pool_id={$pool->id}&action=become_member">{lang->getMsg p1='showpool_become_member_link'}</a></p>
      {/if}
    {/if}
  {else}
    {if $user_is_waiting}
    <p class="msg">{lang->getMsg p1='showpool_become_member_msg_isproven'}</p>
    {else}
    <p class="standard"><a href="./index.php?page=showpool&pool_id={$pool->id}&action=no_member">{lang->getMsg p1='showpool_leavepool_link'}</a><br>
    <a href="./index.php?page=freeres&pool_id={$pool->id}">{lang->getMsg p1='showpool_freeres_link'}</a></p>
    {/if}
  {/if}
  </div>
{/if}
{if $cats}
  <div class="resnavi4"><b>{lang->getMsg p1='showpool_res_header'}</b></div>
  <div class="resnavi5"><br>
  {foreach from=$cats key="cat_id" item="cat"}
  {if $cat_id == 0}<br>{/if}
        <a href="./index.php?page=resbrowser&searchwhere={$pool->id}&cat={$cat_id}">{$cat.name}</a>
        ({$cat.count})<br>
  {/foreach}<br>
  </div>
{/if}
{if $isadmin}
  <div class="resnavi4"><b>{lang->getMsg p1='showpool_admin_header'}</b></div>
  <div class="resnavi5"><br>
  <a href="./index.php?page=pooldata&pool_id={$pool->id}">{lang->getMsg p1='mysite_poolsadmintable_changedatalink'}</a><br>
  <a href="./index.php?page=pooladmin&pool_id={$pool->id}">{lang->getMsg p1='mysite_poolsadmintable_adminlink'}</a><br><br>
  </div>
{/if}
{if !$not_member}  <div class="resnavi4"><b>{lang->getMsg p1='showpool_admins_header'}</b></div>
  <div class="resnavi5"><br>
    {foreach from=$members item="member"}{if $member.admin}
     <a href="./index.php?page=showmember&showmember={$member.obj->id}">{$member.obj->name}</a><br>  
    {/if}{/foreach}<br>
  </div>
  {/if}
{if $members}
  <div class="resnavi4"><b>{lang->getMsg p1='showpool_members_header'}</b></div>
  <div class="resnavi5"><br>
    {foreach from=$members item="member"}{if !$member.admin}
     <a href="./index.php?page=showmember&showmember={$member.obj->id}">{$member.obj->name}</a><br>  
    {/if}{/foreach}<br><br>
  </div>
{/if}
</div>

<div id="poolmaindata">
<div id="resnavi9"><br>
<table class=pooldesc>
<tr>
  <td class=pooldesc1>{lang->getMsg p1='showpool_description'}: </td>
  <td class=pooldesc2>{$pool->getDescription()}</td>
</tr>
<tr>
  <td class=pooldesc1>{lang->getMsg p1='showpool_area'}: </td>
  <td class=pooldesc2>{$pool->area}</td>
</tr>
<tr>
  <td class=pooldesc1>{lang->getMsg p1='showpool_place'}: </td>
  <td class=pooldesc2>{$pool->country}-{$pool->plz} {$pool->city}</td>
</tr>
<tr>
  <td class=pooldesc1>{lang->getMsg p1='showpool_public'}: </td>
  {if $pool->is_public}
  <td class=pooldesc2>{lang->getMsg p1='tables_is_public_yes'}
  {else}
  <td class=pooldesc2>{lang->getMsg p1='tables_is_public_no'}
  {/if}</td>
</tr>
</table><br>
</div>
</div>

  <div id="content2">
{if $form}
  <a href="./index.php?page=showpool&pool_id={$pool->id}">{$pool->name}</a> ->
  {lang->getMsg p1='showpool_forum_new_thread'}
  <br><br>{$form}<br>

{else}
{if $pool}






<table class="res2">
  <tr>
    <th class="showpool" colspan="3">{lang->getMsg p1='showpool_forum_header'}
    </th>
  <tr>
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


{/if}
{/if}

    {foreach from=$members item="member"}<br>
{/foreach}
{include file="footer.tpl"}