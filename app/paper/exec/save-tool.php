<?php  include('../../include.php');

$filename = "tool.json";



/* Si on enregistre un nouveau fichier */
if($_GET["save"]=="save_as" && $_POST["toolName"]!=""){
	$dir 	= DIR_PAPERTOOL."/".$_POST["toolName"]."/";
	if($_POST["toolName"]!=""){
		if(!file_exists($dir))
			mkdir($dir);
	}
}
else {
	$dir 	= DIR_PAPERTOOL."/".$_POST["tool"]."/";
}

	$jsonFile = json_encode($_POST);
	file_put_contents($dir."/".$filename,$jsonFile);

$r = array(
            'infotype'=>"success",
            'msg'=>"Fichier enregistrer",
            'data'=>''
        );

echo json_encode($r);
?>