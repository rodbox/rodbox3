<?php 

include("../../include.php");

$dir =  DIR_RESSOURCES."anim/".$_POST["additem"];
mkdir($dir);

$r = array(
            'infotype'=>"success",
            'msg'=>"ok",
            'data'=>''
        );

echo json_encode($r);
 ?>