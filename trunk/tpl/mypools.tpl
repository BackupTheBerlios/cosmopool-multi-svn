{include file="./header.tpl"}
  <div id="content2">

<table width="100%" class="pools">
  <tr>
	 <th class="pools">{lang->getMsg p1='tableheaders_name'}</th>
	 <th class="pools">{lang->getMsg p1='tableheaders_area'}</th>

    {if $mypoolstable_thirdcol}
	 <th class="pools" width="300"> </th>
	 {/if}

  </tr>
  {foreach from=$mypoolstable item="pool"}
  <tr>
	 <td class="pools1">
	   <a href="./index.php?page=showpool&pool_id={$pool.id}&cat=0&type=0">{$pool.name}</a>
	 </td>
	 <td class="pools1">{$pool.area}</td>

    {if $mypoolstable_thirdcol}
	 <td class="pools1">{$pool.links}</td>
	 {/if}
	 
  </tr>
  {if $pool.id == 1}
  <tr>
	 <td color="white" colspan="2">&nbsp;</td>

    {if $mypoolstable_thirdcol}
	 <td class="pools"> </td>
	 {/if}
	 
  </tr>

  {/if}
  {/foreach}
  <tr>
    {if $mypoolstable_thirdcol}
    <td class="pools" colspan=3>
    {else}
    <td class="pools" colspan=2>
    {/if}
      <a href="index.php?page=poolbrowser&function=public">{lang->getMsg p1='mysite_links_poolbrowser_name'}</a> |
      <a href="index.php?page=pooldata">{lang->getMsg p1='mysite_links_pooldata_name'}</a>
    </td>
  </tr>
</table>


{include file="./footer.tpl"}