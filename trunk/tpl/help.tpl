{include file="header.tpl"}
  <div id="content2">

{foreach from=$headlines key="key" item="headline"}
<img src="./images/linklist_dot.png"> <a href="#{$key}">{$headline}</a><br>
{/foreach}
{$help_content}
<div align="right"><a href="#">top</a></div>

{include file="footer.tpl"}