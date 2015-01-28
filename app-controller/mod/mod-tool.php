<?php 

function merge_unique($array1,$array2){
	$arrayMerge = array_merge_recursive($array1,$array2);


	return super_unique($arrayMerge);
}

	function super_unique($array){
	  $result = array_map("unserialize", array_unique(array_map("serialize", $array)));

	  foreach ($result as $key => $value){
	    if ( is_array($value) )
	      $result[$key] = super_unique($value);
	  }
	  return $result;
	}



 ?>