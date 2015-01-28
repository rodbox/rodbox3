<?php 
/**
 * 		
 */
 class entity extends db
 {
 	
 	function __construct($app,$entity)
 	{	
 		$this->app 		= $app;
 		$this->entity 	= $entity;
 		$this->loadEntity();
 	}

 	function install(){

 	}

 	function alter(){

 	}

 	function insert(){

 	}

 	function del(){

 	}

 	function add(){

 	}

 	function select(){

 	}

 	function loadEntity(){
		$entityAppDIR = DIR_APP."/".$this->app."/entity/".$this->entity.".json";
		$this->entity =  json_decode(file_get_contents($entityAppDIR), true);
 	}

 } ?>