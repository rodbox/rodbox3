<?php 

include("../app-controller.php");
$autoload = new autoload;
$autoload->mod("file");

$list = file::folder_list(DIR_APP);

$compile = [];

$msgInitFile = "msg.xml";

foreach ($list as $key => $value) {
	$info 		= pathinfo($value);
	$app 		= $info["filename"];

	createMsg($app);
	/* msg */
	// $compile = merge_unique($compile,createMsg($app));
}

// $jsonConfigEncode = json_encode($compile,JSON_PRETTY_PRINT);
// file_put_contents($msgInitFile,$jsonConfigEncode);


function createMsg($app){
/* PAGE */
	$newMsgDir = DIR_APP."/".$app."/msg";
	if(!file_exists($newMsgDir))
		mkdir($newMsgDir);

	$msg = $newMsgDir."/msg.xml";
	$msgContent = '{}';

	// file_put_contents($msg,$msgContent);
	$xml = file_put_contents($msg,"<xml></<xml>");
	return $xml;
/* PAGE */
}


 ?>