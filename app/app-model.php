<?php
session_start();

require_once("../app-controller/app-config.php");
require_once("../app-controller/app-controller.php");
app::mod_load("file");
app::mod_load("zip");
app::mod_load("db");
app::mod_load("form");
app::mod_load("ui");
app::appController("user");
extract($_POST);
extract($_GET);

$dir = DIR_APP."/".$pack."/models/".$model.".php";
if(file_exists($dir)){
	include($dir);

	echo json_encode($d);
}


?>
