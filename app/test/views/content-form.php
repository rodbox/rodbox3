<?php
	$form = new form("id form","exec/test.php");
	$form->start();
	
	$form->add("toto");
	$form->add("test");
	$form->getForm();
	
	$form->end();
?>