<?php 

/**
* [PACK]
* $form->add($name="",$type="text",$value="",$options="",$attr=[]);
* $form->req(["name req1"," name req2",... ]);
*/
class form[APP] extends form
{
	function __construct($id,$action,$method="post"){
		parent::__construct($id,$action,$method);
		
		$this->req([
			"required input elem name"
		]);


		$this->add("[APP]");
	}
	
}

 ?>