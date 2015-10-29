<?php 
	require_once("../app-controller/app-controller.php");
    $appAutoload = new appAutoload();
    $c = new controller();

	set_error_handler('errorManagerExec');

	extract($_POST);
	extract($_GET);


	$c->view($app,$view);
?>