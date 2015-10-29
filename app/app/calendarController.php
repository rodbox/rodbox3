<?php 

/**
* 
*/
class calendarController extends controller
{
	

	function eventRemove($d){
		echo '<a href="#" class="removeEvent btn btn-danger" data-id="'.$d[id].'">supprimer</a>';
	}
}

 ?>
