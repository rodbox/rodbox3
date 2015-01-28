<?php 

include("../../include.php");

$dir =  DIR_RESSOURCES."anim/".$_POST["select-perso"]."/".$_POST["addanim"];
mkdir($dir);

$r = array(
            'infotype'=>"success",
            'msg'=>"ok",
            'data'=>''
        );

echo json_encode($r);
 ?>