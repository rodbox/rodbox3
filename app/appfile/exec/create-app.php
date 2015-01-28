<?php
$error = array();

$autoload->mod("template");

extract($_POST);

$tm = new template;
$appName = str_replace(" ", "-", $appName);
$dest = DIR_APP;

$newDest = $dest."/".$appName;
$replace = [
	"CLASSNAME"=>$appName,
	"APP"=>ucfirst($appName),
	"PLUGIN_NAME"=>$appName,
	"DESCRIPTION"=>$description,
	"APP_TITLE"=>$appName
	];
$rename = [
	$newDest."/controller.php"=>$newDest."/".$appName."-controller.php",
	$newDest."/form/form.php"=>$newDest."/form/form".$appName.".php",
	$newDest."/js/jquery-app.js"=>$newDest."/js/jquery-".$appName.".js"
];


$eval = $tm->templateFolder("pack",$dest,$appName,$replace,$rename);



/* Return for json content */
if($eval["r"]){
	$msg 		= $eval["msg"]; // le message de retour pour appInfo
	$infotype 	= "success"; // [loader,success,annonce,error] le type de retour pour appInfo
	$content 	= ""; // du contenu HTML de présentation
	$app 		= array(); // des données spécifiques a l'application
	$eval 		= $eval; // booléen de l'opération
}
else {
	$msg 		= $eval["msg"]; // le message de retour pour appInfo
	$infotype 	= "error"; // [loader,success,annonce,error] le type de retour pour appInfo
	$content 	= ""; // du contenu HTML de présentation
	$app 		= array(); // des données spécifiques a l'application
	$eval 		= $eval; // booléen de l'opération
}
$r = compact($msg,$infotype,$content,$app,$eval);
?>