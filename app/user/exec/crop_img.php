<?php
$error = array();
extract($_POST);
$rand	= substr( md5(rand()), 0, 8);

// use Imagine\Image\Box;
// use Imagine\Image\ImageInterface;
// use Imagine\Imagick\Imagine;

$imagine = new Imagine\Gd\Imagine();
$size    = new Imagine\Image\Box($img["width"],$img["height"]);
$response = true; // true | false | app

$myImg = DIR_MY."/log-ref.jpg";
$myImgSave = DIR_MY."/log.jpg";
$mode    = Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND;





$imagine->open($myImg)

    ->resize($size)
	  ->rotate($data["rotate"])  


	->crop(new Imagine\Image\Point($crop["left"]-$img["left"],$crop["top"]-$img["top"]), new Imagine\Image\Box($crop["width"],$crop["height"]))

        ->thumbnail($size, $mode)
    // ->crop(new Imagine\Image\Point(0,0), new Imagine\Image\Box($crop["width"],$crop["height"]))
    ->save($myImgSave)
;

/**** MON EXEC ****/

/**** END MON EXEC ****/





$valid = (count($error)==0)?true:false; //la condition

/* Return for json content */
if($valid){
	$r = array(
		'infotype'=>"success",	// le message de retour pour appInfo
		'msg'=>"ok",			// [loader,success,annonce,error] le type de retour pour appInfo
	   	'data'=>WEB_MY."/log.jpg?rand=".$rand,			// du contenu HTML de présentation
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