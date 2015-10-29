<?php 
session_start();
require_once("../app-controller/app-controller.php");

    // $appAutoload = new appAutoload();
    $c = new controller();

	set_error_handler('errorManager');
	
	$rService =  $c->service($_POST["service"],$_POST["data"]);
	$msgID = ($rService)?"userExist":"userValid";
	$msg = $c->msg("user",$msgID);

	$r = array(
	            'infotype'=>"success",
	            'msg'=>$msg,
	            'data'=>$rService
	        );
	
	echo json_encode($r);

	// $r = $c->incRoute($_GET["route"]);
	
	// /* Si le fichier exec possede une clés response == false le retour json reste vide */
	// $r["response"] = (array_key_exists("response",$r))?$r["response"]:true;

	// if($r["response"]!=false){
	// 	set_error_handler('errorManagerExec');
	// 	if(isset($r))
	// 		echo json_encode($r);
	// 	else
	// 		trigger_error("Exec error");
	// }

?>