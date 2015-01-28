<?php 
/**
* userController
*/
class userController extends controller
{
	
	function __construct(){
		# code...
	}
	function setUser(){

	}

	function getUser(){
		
	}

	function userMenu(){

		if($this->evalUser())
			$this->view("user","userMenu_connected");
		else
			$this->view("user","userMenu_disconnected");

	}


	function evalUser(){
		return isset($_SESSION["user"]);
	}
}

 ?>