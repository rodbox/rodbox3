<?php 

/**
* User
* $form->add($name="",$type="text",$value="",$options="",$attr=[]);
* $form->req(["name req1"," name req2",... ]);
*/
class formLogin extends form
{
	function __construct($route="user_exec_login",$attr=[]){
		parent::__construct($route,$attr);
		
		$this->setId("formLogin");
		$this->setRoute("user_exec_login");

		$this->setAttr(["class"=>""]);

		$this->req([
			"User",
			"UserPassword",
		]);

		$this->addLabel([
			"User"				=> ["Nom d'utilisateur",""],
			"UserPassword"		=> ["Votre mot de passe",""]
		]);
		
		$this->add("User");
		$this->add("UserPassword","password");
		
		$this->add("submit","submit","Se connecter","",["class"=>"bg-8 c-7  w-100 block pad-5 no-border"]);
	}
	
}

 ?>