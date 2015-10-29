<?php

$error = array();
$appAutoload =  new appAutoload;

/**** MON EXEC ****/
$langList = ["FR","EN","ES","IT"];
    $appList = $c->model("adminmaster","app-list");

	/* Tableau a compiler*/
	$compile = [];
	// $app = [];

	/* Fichier route */
	$routingInitFile = "routing.json";

	/* Parcours de la liste d 'app installer */
	foreach ($appList as $key => $app) {
		// toutes les langs
      	foreach($langList as $keyLang => $lang){
        	// tout les messages de la langue
       		$compile[$lang][$app] = getMsg($app,$lang);
		}

		$app  = $compile;
	}

	foreach($langList as $keyLang => $lang){
		$msgDir = DIR_MSG."/".$lang.".json";
      	$c->setJson($msgDir,$compile[$lang]);
    }
	







	function getMsg($app,$lang){
		$msgDir = DIR_APP."/".$app."/msg/".$lang.".json";


		return $json = json_decode(file_get_contents($msgDir),true);
	}


/**** END MON EXEC ****/
$valid = (count($error)==0)?true:false; //la condition

/* Return for json content */
if($valid){
	$msg 		= "Les messages sont compilées"; // le message de retour pour appInfo
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