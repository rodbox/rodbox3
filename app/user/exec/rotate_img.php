<?php
extract($_GET);
$error = array();

$rand	= substr( md5(rand()), 0, 8);


$response = true; // true | false | app

$dirRef =  DIR_MY."/log-ref.jpg";
$dirLog =  DIR_MY."/log.jpg";

/* REF */
$srcLog     = imagecreatefromjpeg($dirLog);
$rotateImg     = imagerotate($srcLog, $rotate, 0);
imagejpeg($rotateImg,$dirLog,100);

/* LOG */
$srcRef     = imagecreatefromjpeg($dirRef);
$rotateImg     = imagerotate($srcRef, $rotate, 0);
imagejpeg($rotateImg,$dirRef,100);




$valid = (count($error)==0)?true:false; //la condition

/* Return for json content */
if($valid){
	$r = array(
		'infotype'=>"success",	// le message de retour pour appInfo
		'msg'=>"ok",			// [loader,success,annonce,error] le type de retour pour appInfo
	   	'data'=>WEB_MY."/log.jpg?rand=".$rand,				// du contenu HTML de présentation
	   	'app'=>'',				// des données spécifiques a l'application
	   	'valid'=>$valid,			// booléen de l'opération
	   	'response'=>$response
	);
}
else {
	$r = array(
		'infotype'=>"error",	// le message de retour pour appInfo
		'msg'=>"error",			// [loader,success,annonce,error] le type de retour pour appInfo
	   	'data'=>'',				// du contenu HTML de présentation
	   	'app'=>'',				// des données spécifiques a l'application
	   	'valid'=>$valid,			// booléen de l'opération
	   	'response'=>$response
	);
}

?>