<?php
session_start();

require_once("../app-controller/app-config.php");
require_once("../app-controller/app-controller.php");
app::mod_load("file");
app::mod_load("zip");
app::mod_load("form");
app::mod_load("db");
app::mod_load("ui");
app::appController("user");
extract($_POST);
extract($_GET);



$urlInc = $app."/pages/".$page.".php";
$urlCache = $app."/cache/".$page.".html";
$dirCache = $app."/cache/";


function ob_html_compress($buf){
return preg_replace(array('/<!--(.*)-->/Uis',"/[[:blank:]]+/"),array('',' '),str_replace(array("\n","\r","\t"),'',$buf));
}


if(!file_exists($dirCache))
	mkdir($dirCache);

ob_start();
require_once($urlInc);
$buffer = ob_html_compress(ob_get_clean());



file_put_contents($urlCache, $buffer);
?>
