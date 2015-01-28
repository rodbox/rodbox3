<?php
$destination    = "* DESTINATION DES/DU FICHIER(S)*";

$i = 0;
$error = 0;
foreach ($_FILES as $key => $value) {
	$source = $_FILES[$key]['tmp_name'];
	$dest = $destination . "/".$_FILES[$key]['name'];
	if(move_uploaded_file($source, $dest)){
		$i++;
	}
	else{
		$error++;
	}
}


/* Return for json content */
if($error==0){
	$msg 		= $i ." Fichiers uploadés"; // le message de retour pour appInfo
	$infotype 	= "success"; // [loader,success,annonce,error] le type de retour pour appInfo
	$content 	= ""; // du contenu HTML de présentation
	$app 		= array(); // des données spécifiques a l'application
	$eval 		= $eval; // booléen de l'opération
}
else{
	$msg 		= $error ." Problèmes d'enregistrement"; // le message de retour pour appInfo
	$infotype 	= "error"; // [loader,success,annonce,error] le type de retour pour appInfo
	$content 	= ""; // du contenu HTML de présentation
	$app 		= array(); // des données spécifiques a l'application
	$eval 		= $eval; // booléen de l'opération
}
?>