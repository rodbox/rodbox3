<?php 

/**
* 
*/
class appController extends controller
{
	
	function __construct()
	{
		# code...
	}
  
  	// SERVICES
  	function plupload($route,$id=""){
		echo '<form action="'.$this->routeExecUrl($route).'" id="'.$id.'" class="app-plupload"></form>';
  	}

  	function imgrotate($dir,$sens){
		$src     = imagecreatefromjpeg($dir);
		// Rotation
		$rotate     = imagerotate($src, $sens, 0);
		return imagejpeg($rotateFull,$dir,100);
  	}
}

 ?>

 