<?php 

/**
* [PACK]
* $form->add($name="",$type="text",$value="",$options="",$attr=[]);
*/
class formAdminmaster extends form
{
	function __construct($route="adminmaster_exec_save",$attr=[]){
		parent::__construct($route,$attr);
		
		
		

		$this->add("adminmaster");
	}
	
}

 ?>