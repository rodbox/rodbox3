<?php  include('../../include.php');

$filename = "tool.json";
$dir 	= DIR_PAPERTOOL."/".$_POST["tool"]."/";


$json = file_get_contents($dir."/".$filename);
$jsonFile = json_decode($json,true);
$r = array(
            'infotype'=>"success",
            'msg'=>"ok",
            'data'=>$jsonFile
        );

echo json_encode($r);
?>