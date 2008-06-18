{include file="header.tpl"}
<div id="subnavi">
  {if $function==all}{if $res_offers}<a href="./index.php?page=resmanager&function=offers" class="subnavi_linkclosed">{lang->getMsg p1='resmanager_offers_header'}</a>{/if}{if $borrowed_res}<a href="./index.php?page=resmanager&function=borrowed" class="subnavi_linkclosed">{lang->getMsg p1='resmanager_borrowed_header'}</a>{/if}<span class="subnavi_linkactive">{lang->getMsg p1='resmanager_all_header'}</span><span class="subnavi_linkclosed"></span>{/if}
  {if $function==borrowed}{if $res_offers}<a href="./index.php?page=resmanager&function=offers" class="subnavi_linkclosed">{lang->getMsg p1='resmanager_offers_header'}</a>{/if}<span class="subnavi_linkactive">{lang->getMsg p1='resmanager_borrowed_header'}</span><a href="./index.php?page=resmanager&function=all" class="subnavi_linkclosed">{lang->getMsg p1='resmanager_all_header'}</a><span class="subnavi_linkclosed"></span>{/if}
  {if $function==offers}<span class="subnavi_linkactive">{lang->getMsg p1='resmanager_offers_header'}</span>{if $borrowed_res}<a href="./index.php?page=resmanager&function=borrowed" class="subnavi_linkclosed">{lang->getMsg p1='resmanager_borrowed_header'}</a>{/if}<a href="./index.php?page=resmanager&function=all" class="subnavi_linkclosed">{lang->getMsg p1='resmanager_all_header'}</a><span class="subnavi_linkclosed"></span>{/if}
</div>
  <div id="content2">


{if $function==offers}
  <table class="pools">
 	 <tr>
		<th class="pools">{lang->getMsg p1='resmanager_offers_tableheader_what'}</th>
		<th class="pools">{lang->getMsg p1='resmanager_offers_tableheader_offers'}</th>
	 </tr>
    {foreach from=$res_offers item="res"}
    <tr>
		<td class="pools"><b>{$res->name}</b><br>{$res->description}</td>
		<td class="pools">
      {foreach from=$res->wait item="wait"}
            <b>{$wait->user->name}</b>{if $wait->comments}(<b>{lang->getMsg p1='resmanager_offers_comment'}</b>: {$wait->comments}){/if}: <a href="./index.php?page=resmanager&function={$function}&action=wait_res_accept&wait_id={$wait->id}">
            {if $res->type == 0}
              {lang->getMsg p1='resmanager_offers_sendcontact'}
            {/if}
            {if $res->type == 1}
              {lang->getMsg p1='resmanager_offers_give'}
            {/if}
            {if $res->type == 2}
              {lang->getMsg p1='resmanager_offers_lend'}
            {/if}
            </a>, <a href="./index.php?page=resmanager&function={$function}&action=wait_res_refuse&wait_id={$wait->id}">{lang->getMsg p1='resmanager_offers_clear'}</a>
			<br>
      {/foreach}
      </td>
    </tr>
    {/foreach}
  </table>
{/if}

{if $function==borrowed}
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
		<td class="pools"><a href="./index.php?page=resmanager&function={$function}&action=res_back&res_id={$res->id}">{lang->getMsg p1='resmanager_borrowed_isback'}</a></td>
    </tr>
    {/foreach}
  </table>
{/if}

{if $function==all}
  <form action="./index.php?page=resmanager&function={$function}" method="post">
<table width="100%" class="pools">
	{if $userres}
	<tr>
		<th class="pools"> </th>
		<th class="pools">{lang->getMsg p1='resmanager_myrestable_header_category'}</th>
		<th class="pools">{lang->getMsg p1='resmanager_myrestable_header_name'}</th>
		<th class="pools" width="85">{lang->getMsg p1='resmanager_myrestable_header_since'}</th>
		<th class="pools">{lang->getMsg p1='resmanager_myrestable_header_type'}</th>
		<th class="pools"> </th>
	</tr>
   {foreach from=$userres item="res" key="k"}
   {if $k is even}
	<tr>
		<td class="pools1"><input type="checkbox" value="check" name="{$res->id}"></td>
		<td class="pools1">{$res->getCatFormat()}</td>
		<td class="pools1"><b>{$res->name}</b>{if $res->getDescription()}<br>{$res->getDescription()}{/if}</td>
		<td class="pools1" width="85">{$res->getSinceFormat()}</td>
		<td class="pools1">{$res->getTypeFormat()}</td>
		<td class="pools1"><a href="./index.php?page=resdata&res_id={$res->id}&cat={$res->cat}">
        {lang->getMsg p1='resmanager_myrestable_changelink'}
    </a></td>
  </tr>
  {else}
	<tr>
		<td class="pools2"><input type="checkbox" value="check" name="{$res->id}"></td>
		<td class="pools2">{$res->getCatFormat()}</td>
		<td class="pools2"><b>{$res->name}</b>{if $res->getDescription()}<br>{$res->getDescription()}{/if}</td>
		<td class="pools2" width="85">{$res->getSinceFormat()}</td>
		<td class="pools2">{$res->getTypeFormat()}</td>
		<td class="pools2"><a href="./index.php?page=resdata&res_id={$res->id}&cat={$res->cat}">
        {lang->getMsg p1='resmanager_myrestable_changelink'}
    </a></td>
  </tr>
  {/if}
  {/foreach}
	</table>
<img src="./images/arrow.png"> <input type="submit" name="resdata_del_submit" value="{lang->getMsg p1='resmanager_myrestable_delmarked'}"></form><br />
  {else}
	<div class="all_res">
    <tr><td colspan="6" align="center">--- {lang->getMsg p1='resmanager_myrestable_noentrys'} ---</td></tr>
	</table>
  </div>
  {/if}
{/if}


{include file="footer.tpl"}