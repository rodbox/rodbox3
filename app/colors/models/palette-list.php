<?php 
$appAutoload = new appAutoload;
$appAutoload->mod("file");

$dir 	= DIR_PALETTES;


$d= file::folder_list($dir,false);

 ?>