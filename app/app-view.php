<?php 
	require_once("../app-controller/app-controller.php");
    $autoload = new autoload();
    $c = new controller();

	set_error_handler('errorManagerExec');

	$c->view($_POST['app'],$_POST['view']);
?>