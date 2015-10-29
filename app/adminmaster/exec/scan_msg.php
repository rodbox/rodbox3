<?php


extract($_GET);
extract($_POST);

$routingList = getRouting($app);

$formLabelList = getForm($app);


$msgList = getMsg($app);
$new=0;
$msgRoutingList = [];

function getRouting($app){
	$routingFile = DIR_APP."/".$app."/config/routing.json";
	return $json = json_decode(file_get_contents($routingFile),true);
}

function getMsg($app){
	$msgFile = DIR_APP."/".$app."/msg/".LANG_PRINCIPAL.".json";
	return $json = json_decode(file_get_contents($msgFile),true);
}

function setMsg($app,$msgList){
	$msgFile = DIR_APP."/".$app."/msg/".LANG_PRINCIPAL.".json";
	$c = new controller;

	$c->saveMsg($app,LANG_PRINCIPAL);

	// setJson enregiste un array qui va etre convertie au format json dans le fichier pointer;
	$c->setJson($msgFile,$msgList);
	
}

/**
 * retourne un tableau de tout les itemLabel de toutes les form de $app
 * @param  [type] $app [description]
 * @return [type]      [description]
 */
function getForm($app){
	$formDir = DIR_APP."/".$app."/form";
	$formList = file::file_list($formDir);
	$formLabelList = [];
	foreach ($formList as $key => $formFile) {
		// $formLabelList[$form];
		include($formDir."/".$formFile);
		$formName = basename($formFile,".php");
		$form = new $formName;

		foreach($form->formList as $keyFormItem => $valueFormItem){
			$formLabelList[$keyFormItem."Label"]="";
		}

		foreach($form->stepTitle as $keyFormStep => $valueFormStep){
			$formLabelList[$valueFormStep."Step"]=$valueFormStep;
		}
	}





	return $formLabelList;
}

/* Merge routing */
foreach($routingList as $keyRoute => $valRoute){
	$msgKey = $keyRoute."Route";
	// si la route n'est pas referencer dans le fichier de msg alors on l'ajoute sinon rien.
	if(!array_key_exists($msgKey,$msgList)){
		$msgList[$msgKey] = "";
		$new++;
	}
}

/* Merge form */
foreach($formLabelList as $keyForm => $valForm){
	// si l'item du form n'est pas referencer dans le fichier de msg alors on l'ajoute sinon rien.
	if(!array_key_exists($keyForm,$msgList)){
		$msgList[$keyForm] = "";
		$new++;
	}
}




setMsg($app,$msgList);

$r = array(
    'infotype'=>"success",
    'msg'=>"ok",
    'data'=>$msgList
);

?>