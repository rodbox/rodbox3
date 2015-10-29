<?php
$error = array();

/**** MON EXEC ****/
foreach ($_POST as $key => $value) {
	
	$eval = "MA FONCTION DE TRAITEMENT";

	if(!$eval)
		$error[] = $url;
}
/**** END MON EXEC ****/





$valid = (count($error)==0)?true:false; //la condition

/* Return for json content */
if($valid){
	$r = array(
		'infotype'=>"success",	// le message de retour pour appInfo
		'msg'=>"ok",			// [loader,success,annonce,error] le type de retour pour appInfo
	   	'data'=>'',				// du contenu HTML de présentation
	   	'app'=>'',				// des données spécifiques a l'application
	   	'valid'=>$valid			// booléen de l'opération
	);
}
else {
	$r = array(
		'infotype'=>"error",	// le message de retour pour appInfo
		'msg'=>"error",			// [loader,success,annonce,error] le type de retour pour appInfo
	   	'data'=>'',				// du contenu HTML de présentation
	   	'app'=>'',				// des données spécifiques a l'application
	   	'valid'=>$valid			// booléen de l'opération
	);
}

?>