<?php 
$dir = realpath("../models");
file_put_contents($dir.'/'.$_POST["new-file"].'.php','<?php ?>');


$r = array(
            'infotype'=>"success",
            'msg'=>"ok",
            'data'=>DIR_DOC
        );

echo json_encode($r);
 ?>