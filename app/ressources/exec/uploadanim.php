<?php 

include("../../include.php");

// $dir =  DIR_RESSOURCES."anim/item-1/accross";
$dir =  DIR_RESSOURCES."anim/".$_POST["select-perso"]."/".$_POST["select-anim"];
// $filename = "img.png";

print_r($_POST);
$i=0;

foreach ($_FILES as $key => $value) {
	$source = $_FILES[$key]['tmp_name'];
	$dest = $dir . "/".$_FILES[$key]['name'];
	if(move_uploaded_file($source, $dest)){
		$i++;
	}
	else{
		$error++;
	}
}


$r = array(
            'infotype'=>"success",
            'msg'=>"ok",
            'data'=>''
        );

echo json_encode($r);
 ?>