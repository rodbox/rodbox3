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
	$app 		= new app();

ob_start();


	$app->title();
	$json["title"] 	= ob_get_contents();
	ob_clean();

	$app->page();
	$json["page"]	= ob_get_contents();
	ob_clean();

	// $app->appCssPage();
	$json["css"] 	= $app->appCssUrl();
	// $app->appJsPage();
	$json["js"] 	= $app->appJsUrl();
	$json["bg"] 	= $app->app_bg;

ob_end_clean();

 echo json_encode($json);
?>