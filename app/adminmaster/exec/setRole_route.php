<?php
$error = array();

extract($_POST);
// getJson retourne un array du fichier json pointer;
$dirJson = DIR_APP."/".$app."/config/routing.json";
$json = $c->getJson($dirJson);

$json[$route]=[$app,$file,$type,$role];
$c->setJson($dirJson,$json);


$valid = (count($error)==0)?true:false; //la condition
$r = array(
            'infotype'=>"success",
            'msg'=>"ok",
            'app'=>$json
        );

?>