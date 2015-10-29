<?php

$filename = "tool.json";

/* Si on enregistre un nouveau fichier */
if($_GET["save"]=="save_as" && $_POST["toolName"]!=""){

	$dir 	= DIR_PAPERTOOL."/".$_POST["toolName"];
	
	if($_POST["toolName"]!=""){

		if(!file_exists($dir))
			mkdir($dir);
	}
}
else
	$dir 	= DIR_PAPERTOOL."/".$_POST["tool"];


$jsonDir = $dir."/".$filename;

$c->setJson($jsonDir,$_POST)

$r = array(
	'infotype'=>"success",
	'msg'=>"Fichier enregistrer",
	'data'=>''
);


?>