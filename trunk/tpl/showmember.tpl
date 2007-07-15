<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>{lang->getMsg p1='html_title'}</title>
<link rel="stylesheet" type="text/css" href="./inc/style.css">
</head>
<body class="page">
<p id="headlinemember">{$member.obj->name}:</p>
  <div id="contentmember">
  
<p class="standard">

{$member.obj->street} {$member.obj->house}

<br>{$member.obj->plz} {$member.obj->city}

<br>{$member.obj->email}

{if $member.obj->phone}
<br>{$member.obj->phone}
{/if}

{if $member.obj->description}
<br><br><b>{lang->getMsg p1='resdata_form_description'}</b><br>{$member.obj->description}
{/if}

</p>

  </div>
  </body>
</html>
