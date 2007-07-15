{include file="header.tpl"}

{if $res_offers}
  <div class="headline2">{lang->getMsg p1='resmanager_offers_header'}</div><br>
  <table width="100%" class="pools">
 	 <tr>
		<th class="pools">{lang->getMsg p1='resmanager_offers_tableheader_what'}</th>
		<th class="pools">{lang->getMsg p1='resmanager_offers_tableheader_offers'}</th>
	 </tr>
    {foreach from=$res_offers item="res"}
    <tr>
		<td class="pools"><b>{$res->name}</b><br>{$res->description}</td>
		<td class="pools">
      {foreach from=$res->wait item="wait"}
            <b>{$wait->user->name}</b>{if $wait->comments}(<b>{lang->getMsg p1='resmanager_offers_comment'}</b>: {$wait->comments}){/if}: <a href="./index.php?page=resmanager&action=wait_res_accept&wait_id={$wait->id}">
            {if $res->type == 0}
              {lang->getMsg p1='resmanager_offers_sendcontact'}
            {/if}
            {if $res->type == 1}
              {lang->getMsg p1='resmanager_offers_give'}
            {/if}
            {if $res->type == 2}
              {lang->getMsg p1='resmanager_offers_lend'}
            {/if}
            </a>, <a href="./index.php?page=resmanager&action=wait_res_refuse&wait_id={$wait->id}">{lang->getMsg p1='resmanager_offers_clear'}</a>
			<br>
      {/foreach}
      </td>
    </tr>
    {/foreach}
  </table><br>
{/if}

{if $borrowed_res}
  <div class="headline2">{lang->getMsg p1='resmanager_borrowed_header'}</div><br>
  <table width="100%" class="pools">
 	 <tr>
		<th class="pools">{lang->getMsg p1='resmanager_borrowed_tableheader_what'}</th>
		<th class="pools">{lang->getMsg p1='resmanager_borrowed_tableheader_whom'}</th>
		<th class="pools"> </th>
	 </tr>
    {foreach from=$borrowed_res item="res"}
    <tr>
		<td class="pools"><b>{$res->name}</b><br>{$res->description}</td>
		<td class="pools">{$res->borrower->name}</td>
		<td class="pools"><a href="./index.php?page=resmanager&action=res_back&res_id={$res->id}">{lang->getMsg p1='resmanager_borrowed_isback'}</a></td>
    </tr>
    {/foreach}
  </table><br>
{/if}

<div class="headline2">{lang->getMsg p1='resmanager_all_header'}</div><br>
  <form action="./index.php?page=resmanager" method="post">
<table width="100%" class="pools">
	<tr>
		<th class="pools"> </th>
		<th class="pools">{lang->getMsg p1='resmanager_myrestable_header_category'}</th>
		<th class="pools">{lang->getMsg p1='resmanager_myrestable_header_name'}</th>
		<th class="pools">{lang->getMsg p1='resmanager_myrestable_header_since'}</th>
		<th class="pools">{lang->getMsg p1='resmanager_myrestable_header_type'}</th>
		<th class="pools"> </th>
	</tr>
	{if $userres}
   {foreach from=$userres item="res"}
	<tr>
		<td class="pools"><input type="checkbox" value="check" name="{$res->id}"></td>
		<td class="pools">{$res->getCatFormat()}</td>
		<td class="pools"><b>{$res->name}</b><br>{$res->getDescription()}</td>
		<td class="pools">{$res->getSinceFormat()}</td>
		<td class="pools">{$res->getTypeFormat()}</td>
		<td class="pools"><a href="./index.php?page=resdata&res_id={$res->id}&cat={$res->cat}">
        {lang->getMsg p1='resmanager_myrestable_changelink'}
    </a></td>
  </tr>
  {/foreach}
  {else}
  <tr>
    <td colspan="6" align="center">--- {lang->getMsg p1='resmanager_myrestable_noentrys'} ---</td>
  </tr>
  {/if}
</table>
<img src="./images/arrow.png"> <input type="submit" name="resdata_del_submit" value="{lang->getMsg p1='resmanager_myrestable_delmarked'}"></form><br />



{include file="footer.tpl"}