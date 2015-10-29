<?php
$error = array();

$eventPersoList = $c->getJson(DIR_MY."/events.json");
$eventProjectList = $c->getJson(DIR_PROJECTS."/photos/events.json");

$eventList = array_merge($eventPersoList,$eventProjectList);

$valid = (count($error)==0)?true:false; //la condition

/* Return for json content */
if($valid){
	$r = array(
		'response'=>'app',		// true : return $valid bool || false return json || app return app
		'infotype'=>"success",	// le message de retour pour appInfo
		'msg'=>"ok",			// [loader,success,annonce,error] le type de retour pour appInfo
	   	'data'=>'',				// du contenu HTML de présentation
	   	'app'=>json_encode($eventList),				// des données spécifiques a l'application
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