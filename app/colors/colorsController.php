<?php 

/**
* 
*/
class colorsController extends controller
{
	
	function __construct()
	{
		# code...
	}
  
  function getPalettesList(){
  	$this->view("colors","palettes-list-select","palette-list");
  	
  }
}

 ?>