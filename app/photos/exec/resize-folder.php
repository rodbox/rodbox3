<?php
$error = array();

/**** MON EXEC ****/
foreach ($_POST["A TRAITER"] as $key => $value) {
	
	$eval = "MA FONCTION DE TRAITEMENT";

	if(!$eval)
		$error[] = $url;
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