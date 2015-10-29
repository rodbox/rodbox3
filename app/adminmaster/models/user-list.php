<?php 
	$em = $c->getEM();

	$c->getEntity("user","userEntity");
	$d = $em->getRepository("userEntity")->findAll();

	
	// $em->persist($newElem );
	// $em->flush();

 ?>