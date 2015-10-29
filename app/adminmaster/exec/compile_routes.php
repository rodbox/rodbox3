<?php

$error = array();
$appAutoload =  new appAutoload;

/**** MON EXEC ****/
$appAutoload->mod("file");
	$list = file::folder_list(DIR_APP);

	/* Tableau a compiler*/
	$compile = [];
	$app = [];

	/* Fichier route */
	$routingInitFile = "routing.json";

	/* Parcours de la liste d 'app installer */
	foreach ($list as $key => $value) {
		$info 		= pathinfo($value);
		$app 		= $info["filename"];
		/* Routing */
		$compile = merge_unique($compile,getRouting($app));
	}
	$app  = $compile;
	$jsonConfigEncode = json_encode($compile,JSON_PRETTY_PRINT);

	$c->saveRouting();

	file_put_contents(DIR_ROUTING,$jsonConfigEncode);

	function getRouting($app){
		$configDir = DIR_APP."/".$app."/config";
		$routingFile = $configDir."/routing.json";

		return $json = json_decode(file_get_contents($routingFile),true);
	}


/**** END MON EXEC ****/



$valid = (count($error)==0)?true:false; //la condition

/* Return for json content */
if($valid){
	$msg 		= "Les routes sont compilées"; // le message de retour pour appInfo
	$infotype 	= "success"; // [loader,success,annonce,error] le type de retour pour appInfo
	$content 	= ""; // du contenu HTML de présentation
	$app 		= ""; // des données spécifiques a l'application
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