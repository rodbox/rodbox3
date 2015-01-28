<?php 
$dir = realpath("../models");
$jsonDir = $dir.'/'.$_POST["models"].'/'.$_POST["models"].'.json';

$json = json_decode(file_get_contents($jsonDir),true);

$r = array(
            'infotype'=>"success",
            'msg'=>"ok",
            'data'=>$json
        );

echo json_encode($r);
 ?>