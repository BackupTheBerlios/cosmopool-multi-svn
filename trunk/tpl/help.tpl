{include file="header.tpl"}

{foreach from=$headlines item="headline"}
<img src="./images/linklist_dot.png"> <a href="#1">{$headline}</a><br>
{/foreach}
{$help_content}
<div align="right"><a href="#">top</a></div>

{include file="footer.tpl"}