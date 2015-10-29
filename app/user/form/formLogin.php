<?php 

/**
* User
* $form->add($name="",$type="text",$value="",$options="",$attr=[]);

*/
class formLogin extends form
{
	function __construct($route="user_exec_login",$attr=[]){
		parent::__construct($route,$attr);
		
		$this->setId("formLogin");
		$this->setAppMsg("user");
		$this->setRoute("user_exec_login");

		$this->setAttr(["class"=>""]);

		$this->setControl([
			"User"=>["req"=>true],
			"UserPassword"=>["req"=>true]
		]);

		
		$this->add("User","text","","",["autofocus"=>true]);
		$this->add("UserPassword","password");

		$this->add("UserRemember","checkbox",[],["remember_me"=>$this->msg("user","UserRememberLabel")],["class"=>"w-100"]);
		
		$this->add("submit","submit","Se connecter","",["class"=>"bg-8 c-7  w-100 block pad-5 no-border"]);
	}
	
}

 ?>