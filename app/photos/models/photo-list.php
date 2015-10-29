<?php
	// extract($send);
	$appAutoload = new appAutoload;
	$appAutoload->mod("file");

	$d = file::file_list(DIR_PHOTOS."/000",true);

?>