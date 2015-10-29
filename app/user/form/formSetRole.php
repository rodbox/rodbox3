<?php 

/**
* User
* $form->add($name="",$type="text",$value="",$options="",$attr=[]);
* $form->req(["name req1"," name req2",... ]);
*/
class formSetRole extends form
{
	function __construct($route="user_exec_set_role",$attr=[]){
		parent::__construct($route,$attr);
		
		$this->setRoute("user_exec_set_role");
		$this->setAppMsg("user");
		$this->setAttr(["class"=>"formSetRole"]);

		$this->setControl([]);



		
		$this->add("id","hidden");
      
		$roleList = ["FREE"=>"FREE","USER"=>"USER","EDITOR"=>"EDITOR","GRAPH"=>"GRAPH","ADMIN"=>"ADMIN","MASTER"=>"MASTER"];
		$this->add("role","select","",$roleList,["class"=>"submitOnChange"]);

	}
	
}

 ?>