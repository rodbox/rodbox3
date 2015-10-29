<?php 
$array1 = array(1,2,3,5,3,4);
$array2 = array(4,5,3);

foreach ($array1 as $key => $value) {
	$eval = in_array($value, $array2);
	return true;
}





 ?>