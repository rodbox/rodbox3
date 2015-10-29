<?php 

/**
* User
* $form->add($name="",$type="text",$value="",$options="",$attr=[]);
* $form->step("stepName");
* $form->setControl(["nameItem"=>["controle1"=>true,"controle2"=>false,...]]);
*/
class formUser extends form
{
	function __construct($route="user_exec_create",$attr=[]){
		parent::__construct($route,$attr);
		
		$this->setId("formUser");
		$this->setAppMsg("user");
		$this->setLabelShow("placeholder");
		$this->setRoute("user_exec_create");

			$this->setControl([
			"User" => [
				"req"=>true,
				"min"=>3,
				"max"=>15
			],
			"UserPassword"	=> [
				"req"	=> true,
				"min"	=> "6"
			],

			"UserPassword_confirm"=>[
				"req"	=> true,
				"equal" => "UserPassword"
			],
			"UserLastname"		=>["req"=>true],
			"UserFirstname"		=>["req"=>true],
			"UserLang"			=>["req"=>true],
			"UserDateBorn"		=>["date"=>true],
			"UserTel"			=>["tel"=>true],
			"UserMail"			=>[
				"req"=>true,
				"mail"=>true
			]
		]);

		

		$this->setAttr([
			"class"=>"applive-formUser",
			"autocomplete"=>"off"
		]);

		$this->setExemple([
			"UserMail" => "john.doe@yahoo.fr",
			"UserDateBorn" => [
				"dd-mm-yyyy",
				"dd/mm/yyyy"
			],
			"UserTel" => [
				"01 34 56 32 22",
				"04.54.36.46.97"
				]
			]);
		
      	$langList = ["FR"=>"FR","EN"=>"EN","ES"=>"ES","IT"=>"IT"];
      
		$this->step("UserStep");

		$this->add("User","text","","",["autocomplete"=>"off"]);
		$this->add("UserPassword","password");
		$this->add("UserPassword_confirm","password");

		$this->step("PersonnalStep");

		$this->add("UserLang","checkbox",[],$langList);
		$this->add("UserCiv","radio","",["MALE"=>$this->msg("app","male"),"FEMALE"=>$this->msg("app","female")]);

		$this->step("PersonnalStep");

		$this->add("UserLastname");
		$this->add("UserFirstname");
		$this->add("UserDateBorn","date");

		$this->step("SocialStep");
	
		$this->add("UserMail","email");
		$this->add("UserSkype");
		$this->add("UserTel");
		$this->add("UserFacebook");
		$this->add("UserTwitter");
		$this->add("UserPinterest");

		$this->add("submit","submit","envoyer","",["class"=>"bg-2 c-7 no-border"]);

		// $this->validate();
	}
}

 ?>