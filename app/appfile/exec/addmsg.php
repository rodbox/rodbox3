<?php
$error = array();
extract($_POST);
/**** MON EXEC ****/
$msg = // getJson retourne un array du fichier json pointer;
$dirJson = DIR_APP."/".$_POST["app-select"]."/msg/".LANG_PRINCIPAL.".json";
$json = $c->getJson($dirJson);
if(is_array($json) && array_key_exists($key,$json)){
	$error[]="la clé existe déja";
}
else{
	$json[$key]=$_POST["msg"];
	$c->setJson($dirJson,$json);
}

/**** END MON EXEC ****/





$valid = (count($error)==0)?true:false; //la condition

/* Return for json content */
if($valid){
	$msg 		= "Opération validé"; // le message de retour pour appInfo
	$infotype 	= "success"; // [loader,success,annonce,error] le type de retour pour appInfo
	$content 	= ""; // du contenu HTML de présentation
	$app 		= array(); // des données spécifiques a l'application
	$eval 		= $valid; // booléen de l'opération
}
else {
	$msg 		= "Echec de l'opération"; // le message de retour pour appInfo
	$infotype 	= "error"; // [loader,success,annonce,error] le type de retour pour appInfo
	$content 	= ""; // du contenu HTML de présentation
	$app 		= array(); // des données spécifiques a l'application
	$eval 		= $valid; // booléen de l'opération
}
$r = compact($msg,$infotype,$content,$app,$eval);
?>