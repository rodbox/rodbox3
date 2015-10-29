<?php

$appAutoload->mod("template");

$tm = new template;
$app = $_POST["app-select"];
$type = $_POST["route-type"];
$file = $_POST["route-file"];
$role = $_POST["role"];

if($type=="page"||$type=="exec"||$type=="service"){
	$templateFile 	= $type.".php";
	/* Juste pour corriger la destination si le type de route est page on rajoute un 's'. */
	if($type=="page")
		$folder = "pages";
	else if ($type=="view")
		$folder = "views";
	else
		$folder = $type;
	$target 		= DIR_APP."/".$app."/".$folder;
	$route_file 	= $file;

	$eval = $tm->templateFile($templateFile,$target,$route_file);
}
else{
	// il sagit d'un service
	$eval["eval"] = true;
}


/* Si le fichier n'existe pas et qu'il a bien été créer 
on créer la nouvelle route et on l'integre au fichier routing de l'app.
Il faut ensuite le compiler pour le kernel.
*/
if($eval["eval"]){
	$newRouteName = $app."_".$type."_".$file;
	$newRoute = [
		$app,
		$file,
		$type,
		$role
	];

	$dirRoute = DIR_APP."/".$app."/config/routing.json";
	// getJson retourne un array du fichier json pointer;
	$jsonRouting = $c->getJson($dirRoute);
	$jsonRouting[$newRouteName] = $newRoute;
	
	// setJson enregiste un array qui va etre convertie au format json dans le fichier pointer;
	$c->setJson($dirRoute,$jsonRouting);
}



if($eval["eval"]==true){
$r = array(
	    'infotype'=>"success",
	    'msg'=>"Route créer",
	    'data'=>''
    );
}
else{
	$r = array(
        'infotype'=>"error",
        'msg'=>"Le fichier existe déja",
        'data'=>''
    );
}




?>