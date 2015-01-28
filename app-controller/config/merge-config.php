<?php 

include("../app-controller.php");
$autoload = new autoload;
$autoload->mod("file");

$list = file::folder_list(DIR_APP);

$compile = array();

$routingInitFile = "routing.json";

foreach ($list as $key => $value) {
	$info 		= pathinfo($value);
	$app 		= $info["filename"];
	/* Routing */
	$compile = merge_unique($compile,getRouting($app));
}

$jsonConfigEncode = json_encode($compile,JSON_PRETTY_PRINT);
file_put_contents($routingInitFile,$jsonConfigEncode);




function getRouting($app){
	$configDir = DIR_APP."/".$app."/config";
	$routingFile = $configDir."/routing.json";
	return $json = json_decode(file_get_contents($routingFile),true);
}
















function createIndex($app){
/* PAGE */
	$newPageDir = DIR_APP."/".$app."/pages";
	if(!file_exists($newPageDir))
		mkdir($newPageDir);

	$indexPage = $newPageDir."/index.php";
	$indexPageContent = '<?php $c->view("'.$app.'","content");?>';

	file_put_contents($indexPage,$indexPageContent);
/* PAGE */
}











function generateRouting($app){
/* ROUTING */
	$configDir = DIR_APP."/".$app."/config";

	if(!file_exists($configDir))
		mkdir($configDir);

	$routingFile = $configDir."/routing.json";
	$jsonConfig = [];

/* Routing de page */
	$pagesDir = DIR_APP."/".$app."/pages";
	$listPage = file::file_list($pagesDir);
	foreach ($listPage  as $key => $value) {
		$page = basename($value, ".php");
		$pageID = $app."_page_".$page;
		$jsonConfig[$pageID]=[$app,$page,"page"];
	}
/* END Routing de page */
/* Routing de Exec */
	$execDir = DIR_APP."/".$app."/exec";
	if(file_exists($execDir)){
		$listExec = file::file_list($execDir);
		foreach ($listExec  as $key => $exec) {
			$exec = basename($exec, ".php");
			$execID = $app."_exec_".$exec;
			$jsonConfig[$execID]=[$app,$exec,"exec"];
		}
	}
	
/* END Routing de Exec */

	$jsonConfigEncode = json_encode($jsonConfig,JSON_PRETTY_PRINT);
	file_put_contents($routingFile,$jsonConfigEncode);

	return $jsonConfig;
/* ROUTING */
}

 ?>