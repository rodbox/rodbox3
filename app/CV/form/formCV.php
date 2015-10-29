<?php 

/**
* [PACK]
* $form->add($name="",$type="text",$value="",$options="",$attr=[]);
* $form->req(["name req1"," name req2",... ]);
*/
class formCV extends form
{
	function __construct($route="CV_exec_save",$attr=[]){
		parent::__construct($route,$attr);
		
		
		

		$this->add("CV");
	}
	
}

 ?>