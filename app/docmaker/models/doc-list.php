<?php
$appAutoload = new appAutoload();
	$appAutoload->mod("file");

	$d  = file::folder_list(DIR_DOC,false);
?>