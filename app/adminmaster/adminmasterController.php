<?php 

/**
* adminmasterController
*/
class adminmasterController extends controller
{
	
	function __construct()
	{
		# code...
	}
  
  	function compile_route(){
    	$this->exec("adminmaster","compile_route");
    }
  
  	function select_app(){
    	$this->view("adminmaster","select-app","app-list");
    }
    

}

 ?>