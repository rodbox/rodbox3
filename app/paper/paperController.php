<?php 

/**
* 
*/
class paperController extends controller
{
	
	function __construct()
	{
		# code...
	}
  
  function getToolList(){
    $this->view("paper","toollist","toollist");
  }
}

 ?>