<?php

$handle = fopen('./counter.dat', 'r');
echo "page-impression by month<br><br>";
while(!feof($handle)) 
  echo(fgets($handle,1024).'<br>');
fclose($handle);

?>