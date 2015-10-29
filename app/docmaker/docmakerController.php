<?php 

/**
* 
*/
class docmakerController extends controller
{
	
	function __construct()
	{
		# code...
	}
  
  function getDocList(){
  	$this->view("docmaker","doc-list","doc-list");
    
  }
  
}

 ?>