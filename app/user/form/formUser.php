<?php 

/**
* User
* $form->add($name="",$type="text",$value="",$options="",$attr=[]);
* $form->req(["name req1"," name req2",... ]);
*/
class formUser extends form
{
	function __construct($route="user_exec_create",$attr=[]){
		parent::__construct($route,$attr);
		
		$this->setId("formUser");
		$this->setRoute("user_exec_create");

		$this->req([
			"User",
			"UserLastname",
			"UserFirstname",
			"UserPassword",
			"UserMail",
		]);

		$this->setAttr(["class"=>"appliveform"]);

		$this->addLabel([
			"User"				=> ["Nom d'utilisateur","Minimim 5 caractères"],
			"UserLastname"		=> ["Nom de famille",""],
			"UserFirstname"		=> ["Prénom",""],
			"UserCiv"			=> ["Civilité",""],
			"UserPassword"		=> ["Votre mot de passe",""],
			"UserPassword_confirm"	=> ["Confirmez votre mot de passe",""],
			"UserMail"			=> ["Email",""]
		]);
		
		$this->add("User");
		$this->add("UserPassword","password");
		$this->add("UserPassword_confirm","password");
		$this->add("UserCiv","radio","Mme",["Mme"=>"Mme","Mlle"=>"Mlle","M"=>"M"]);
		$this->add("UserLastname");
		$this->add("UserFirstname");
		$this->add("UserMail","email");
		
		$this->add("submit","submit","envoyer");
	}
	
}

 ?>