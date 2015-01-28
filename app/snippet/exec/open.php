<?php 
extract($_GET);
$src = realpath("../snippets")."/".$snippetName;
// $xmlStr = file_get_contents($src);
// $xmlObj = simplexml_load_string($xmlStr);
$xmlObj = simplexml_load_file($src);

$d['snippetName'] = $snippetName;
$d['trigger'] =  $xmlObj->tabTrigger;
$d['content'] =  $xmlObj->content;
$d['desc'] =  $xmlObj->description;



?>
