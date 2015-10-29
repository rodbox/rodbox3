<?php 
	session_start();
	require_once("../app-controller/app-controller.php");
	
	extract($_POST);
	extract($_GET);

    // $appAutoload = new appAutoload();
    $c = new controller();

	// set_error_handler('errorManager');
		error_reporting(0);
ob_start();
	$d= (isset($send))?$send:[];
	$c->incRoute($route,$d);
$content = ob_get_clean();

	
	$infoRoute = $c->infoRoute($route);

	$r = [
		"title"=>$c->msg($infoRoute[0],$route."Route"),
		"content"=>$content
	];


	echo json_encode($r);
	// /* Si le fichier exec possede une clés response == false le retour json reste vide */
	// $r["response"] = (array_key_exists("response",$r))?$r["response"]:true;

	// if($r["response"]==="app" && array_key_exists("app",$r)){
	// 	echo $r['app'];
	// }
	// else {
	// 	if($r["response"]){
	// 		set_error_handler('errorManagerExec');
	// 		if(isset($r))
	// 			echo json_encode($r);
	// 		else
	// 			trigger_error("Exec error");
	// 	}
	// }
?>