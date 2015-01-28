<?php 
$dir = realpath("../models");

if($_POST["new-file"]!="") {
	$_POST["models"] = $_POST["new-file"];
	$json  = json_encode($_POST);
	$new = false;
	$dir = $dir.'/'.$_POST["new-file"];
	if(!file_exists($dir)){
		mkdir($dir);
		$new = true;
	}

	file_put_contents($dir.'/'.$_POST["new-file"].'.json',$json);

	$r = array(
	            'infotype'=>"success",
	            'msg'=>"Fichier enregistré",
	            'data'=>["new"=>$new,"models"=>$_POST["new-file"]]
	        );

	echo json_encode($r);
}
else {
	$r = array(
	            'infotype'=>"error",
	            'msg'=>"Vous devez saisir un nom de fichier",
	            'data'=>''
	        );
	
	echo json_encode($r);
}
?>
