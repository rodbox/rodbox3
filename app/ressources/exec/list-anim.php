<?php 
include("../../include.php");
$folder = "anim/".$_POST["select-perso"];

$dir = DIR_RESSOURCES.$folder;
$list = rscandir($dir);




$d = ["list"=>$list,"url"=>WEB_RESSOURCES.$folder."/"];

$r = array(
            'infotype'=>"success",
            'msg'=>"ok",
            'data'=>$d
        );

echo json_encode($r); ?>