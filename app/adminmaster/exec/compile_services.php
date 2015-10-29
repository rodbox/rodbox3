<?php


$error = array();
/******/

$appAutoload =  new appAutoload;
$appAutoload->mod("file");

$list = file::folder_list(DIR_APP);

$compile = [];

$serviceInitFile = "services.json";

foreach ($list as $key => $value) {
	$info 		= pathinfo($value);
	$app 		= $info["filename"];

	// createService($app);
	/* service */
	/* LOG compile service */
	$c->log("compile service",__FILE__,$app);
	/* END LOG compile service */
	$compile = merge_unique($compile,createService($app));
}

$jsonConfigEncode = json_encode($compile,JSON_PRETTY_PRINT);
$c->saveServices();
file_put_contents(DIR_SERVICES,$jsonConfigEncode);


function createService($app){
/* PAGE */
	$newServiceDir = DIR_APP."/".$app."/config";
	if(!file_exists($newServiceDir))
		mkdir($newServiceDir);

	$service = $newServiceDir."/services.json";
	$serviceContent = '{}';

	// file_put_contents($service,$serviceContent);
	$json = json_decode(file_get_contents($service),true);
	return $json;
/* PAGE */
}

/******/





$valid = (count($error)==0)?true:false; //la condition

/* Return for json content */
if($valid){
	$msg 		= "Les services sont compilées"; // le message de retour pour appInfo
	$infotype 	= "success"; // [loader,success,annonce,error] le type de retour pour appInfo
	$content 	= ""; // du contenu HTML de présentation
	$app 		= array(); // des données spécifiques a l'application
	$eval 		= ""; // booléen de l'opération
}
else {
	$msg 		= "Echec de l'opération"; // le message de retour pour appInfo
	$infotype 	= "error"; // [loader,success,annonce,error] le type de retour pour appInfo
	$content 	= ""; // du contenu HTML de présentation
	$app 		= array(); // des données spécifiques a l'application
	$eval 		= ""; // booléen de l'opération
}

$r = compact($msg,$infotype,$content,$app,$eval);
?>