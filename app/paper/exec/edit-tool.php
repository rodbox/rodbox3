<?php

$filename 	= "tool.json";
$dir 		= DIR_PAPERTOOL."/".$_POST["tool"];

$jsonDir 	= $dir."/".$filename;
$jsonFile 	= $c->getJson($jsonDir);

$r = array(
	'infotype'	=> "success",
	'msg'		=> "ok",
	'data'		=> $jsonFile
);


?>