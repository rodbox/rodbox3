<?php 
	$appAutoload =  new appAutoload;
	$appAutoload->mod("file");

	$d = json_decode(file_get_contents(DIR_SERVICES),true);
?>