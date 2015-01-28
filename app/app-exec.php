<?php 
require_once("../app-controller/app-controller.php");

    $autoload = new autoload();
    $c = new controller();
	set_error_handler('errorManagerExec');

	$dir = DIR_APP."/".$c->app."/exec/".$c->exec.".php";
	
	if(require_once($dir)){
	echo json_encode($r);
	}
	else{
		echo "error exec";
	}
?>