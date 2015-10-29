<?php 

/**
* User
* $form->add($name="",$type="text",$value="",$options="",$attr=[]);
* $this->setControl([
			"nameItem" => [
				"max"=>15,
				"min"=>3
				"req"=>true,
			...
			],
			...
			]);

*/
class formUserEdit extends form
{
	function __construct($route="user_exec_create",$attr=[]){
		parent::__construct($route,$attr);
		
		$this->setId("formUser");

		$this->setRoute("user_exec_upd");
		$this->setAppMsg("user");
		$this->setControl([
			
			"UserLastname"		=>["req"=>true],
			"UserFirstname"		=>["req"=>true],
			"UserTel"			=>["tel"=>true],
			"UserMail"			=>[
				"req"=>true,
				"mail"=>true
			]
		]);

		$this->setExemple([
			"UserMail" => "john.doe@yahoo.fr",
			"UserTel" => [
				"01 34 56 32 22",
				"04.54.36.46.97"
				]
			]);

		$this->setAttr(["class"=>"appliveform"]);
		
      	$langList = ["FR"=>"FR","EN"=>"EN","ES"=>"ES","IT"=>"IT"];
      
		$this->add("id","hidden");
		
		// $this->add("User");
		$this->add("UserLang","checkbox",[],$langList);
		$this->add("UserCiv","radio","",["MALE"=>$this->msg("app","male"),"FEMALE"=>$this->msg("app","female")]);
		$this->add("UserLastname");
		$this->add("UserFirstname");
		$this->add("UserMail","email");
		$this->add("UserTel","number");
		$this->add("UserSkype");
		$this->add("UserTel");
		$this->add("UserFacebook");
		$this->add("UserTwitter");
		$this->add("UserPinterest");

		
		$this->add("submit","submit","envoyer","",["class"=>"bg-2 c-7 no-border"]);
	}
	
}

 ?>