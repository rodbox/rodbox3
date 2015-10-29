<?php 
$dir = DIR_DOC;
$jsonDir = $dir.'/'.$_POST["doc-list"].'/'.$_POST["doc-list"].'.json';


$json = $c->getJson($jsonDir);

$r = array(
            'infotype'=>"success",
            'msg'=>"ok",
            'data'=>$json
        );
 ?>