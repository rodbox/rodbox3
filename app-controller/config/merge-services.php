<?php 

include("../app-controller.php");
$autoload = new autoload;
$autoload->mod("file");

$list = file::folder_list(DIR_APP);

$compile = [];

$serviceInitFile = "services.json";

foreach ($list as $key => $value) {
	$info 		= pathinfo($value);
	$app 		= $info["filename"];

	// createService($app);
	/* service */
	$compile = merge_unique($compile,createService($app));
}

$jsonConfigEncode = json_encode($compile,JSON_PRETTY_PRINT);
file_put_contents($serviceInitFile,$jsonConfigEncode);


function createService($app){
/* PAGE */
	$newServiceDir = DIR_APP."/".$app."/config";
	if(!file_exists($newServiceDir))
		mkdir($newServiceDir);

	$service = $newServiceDir."/services.json";
	$serviceContent = '{}';

	// file_put_contents($service,$serviceContent);
	$json = json_decode(file_get_contents($service),true);
	return $json;
/* PAGE */
}


 ?>