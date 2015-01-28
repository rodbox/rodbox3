<?php  
$dir = DIR_ROOT;
$dirFile = $dir.$_POST["file"];

$fileContent = file_get_contents($dirFile);

$r = array(
            'infotype'=>"success",
            'msg'=>"ok",
            'data'=>['fileContent'=>$fileContent]
        );


?>