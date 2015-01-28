<?php

	session_start();

	require_once("../app-controller/app-config.php");
	require_once("../app-controller/app-controller.php");


	extract($_POST);
	extract($_GET);

	$file = basename($dir);
	$real_dir  = DIR_ROOT."/".$dir;
if(file_exists($real_dir)){
	header('Content-type:force-download'); 
	header('Content-Disposition: attachment; filename='.$file);

	readfile($real_dir);
}

?>