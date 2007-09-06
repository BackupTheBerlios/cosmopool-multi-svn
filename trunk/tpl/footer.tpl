
  </div>
    <div id="footer"> <a href="./index.php?page=static&pageid=about">{lang->getMsg p1='common_bottom_about'}</a> |&nbsp; 
    <a href="http://www.whopools.net/software/" target="_blank">{lang->getMsg p1='common_bottom_developers'}</a> |&nbsp;
    <a href="http://www.cosmopool.net" target="_blank">{lang->getMsg p1='common_bottom_supersite'}</a>    |&nbsp; 
    <a href="./index.php?page=static&pageid=contact">{lang->getMsg p1='common_bottom_contact'}</a> </div>
</div>
  {if $footerlinks}
  <div id="linklist">
    <div class="linklist_links">
      <a class="navi" href="index.php?page=mysite">{lang->getMsg p1='link_mysite'}</a>
    </div>
    <div class="linklist_links">
      <a class="navi" href="index.php?page=search"> {lang->getMsg p1='common_footerlinks_search'}</a>
    </div>
    <div class="linklist_links">
      <a class="navi" href="index.php?page=userdata"> {lang->getMsg p1='mysite_links_userdata_name'}</a>
    </div>
    <div class="linklist_links">
      <a class="navi" href="index.php?page=resmanager">{lang->getMsg p1='mysite_res_header'}</a>
    </div>
    <div class="linklist_links2">
    <a class="navi" href="index.php?page=resdata"> {lang->getMsg p1='mysite_links_resdata_name'}</a>
    </div>
    <div class="linklist_links">
      <a class="navi" href="index.php?page=mypools"> {lang->getMsg p1='mysite_mypools_header'}</a>
    </div>
  </div>
  {else}
  <div id="linklist">
        <a href="index.php?page=home"><< {lang->getMsg p1='homepage_backlink'}</a>
  </div>
  
  {/if}
  {if $todo} 
  <div id="todolist">
    <b>toDo</b><br><br>
    <div id="todolist_links">
      {if $todo.res}
      / <a href="index.php?page=resmanager">{$todo.res} Anfragen</a>
      {/if}
      {if $todo.user}
      {foreach from=$todo.user item="pool"}
      <br><br><b>{$pool.pool->name}</b>:<br>
		\ <a href="index.php?page=pooladmin&pool_id={$pool.pool->id}">{$pool.count} Nutzis warten</a>
		{/foreach}
      {/if}
    </div>
  </div>
   
  {/if}
  <!-- 4stats Tracker Code // begin -->
<script type="text/javascript" language="javascript" src="http://4stats.de/de/counter?id=21841&cntr=hide"></script><noscript><a href="http://www.4stats.de/" target="_blank"><img src="http://4stats.de/de/stats?id=21841&cntr=hide" border="0" alt="4stats Webseiten Statistik + Counter" /></a></noscript>
<!-- 4stats Tracker Code // end -->


  </body>
</html>


