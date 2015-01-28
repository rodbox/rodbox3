<?php  
$dir = DIR_ROOT;
$dirFile = $dir.$_POST["file"];
$dirFileMark = DIR_META.$_POST["file"].".meta";

$eval1 = file_put_contents($dirFile,$_POST["fileContent"]);

/* Méta données */
// $eval2 = file_put_contents($dirFileMark,$_POST["fileMarks"]);

	$r = array(
            'infotype'=>"success",
            'msg'=>"Fichier enregistré",
            'data'=>''
        );

?>