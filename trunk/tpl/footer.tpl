
  </div>
  {if $footerlinks}
  <div id="linklist">
    <div id="linklist_links">
      {foreach from=$footerlinks item="link"}
      {if $link.page == "blank"}
        <br>
      {else}
        <img src="./images/linklist_dot.png"> <a href="index.php?page={$link.page}&amp;{$link.params}">{$link.name}</a><br>
      {/if}
      {/foreach}
    </div>
  </div>
  {else}
  <div id="linklist">
    <div id="linklist_links">
        <a href="index.php?page=home"><< {lang->getMsg p1='homepage_backlink'}</a>
    </div>
  </div>
  
  {/if}
  {if $todo} 
  <div id="todolist">
    <img src="./images/linklist_todo.png" id="linklist_todo">
    <div id="todolist_links">
      {if $todo.res}
      <p><img src="./images/linklist_dot.png"> <a href="index.php?page=resmanager">{$todo.res} Anfragen</a></p>
      {/if}
      {if $todo.user}
      {foreach from=$todo.user item="pool"}
      <p>{$pool.pool->name}:<br>
		<img src="./images/linklist_dot.png"> <a href="index.php?page=pooladmin&pool_id={$pool.pool->id}">{$pool.count} Nutzis warten</a></p>
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


