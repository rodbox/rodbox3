<?php 

/**
* User
* $form->add($name="",$type="text",$value="",$options="",$attr=[]);
* form type :
* 	text
* 	date
* 	textarea
* 	password
* 	submit
* 	hidden
* 	select
* 	radio
* 	checkbox
* 	range
* 	codemirror
*
* form setControl :
* 	int
* 	mail
* 	alpha_num
* 	reg => REGEXP
* 	req
* 	min => MIN
* 	max => MAX
* 	equal => ITEM_NAME
* 	url
* 	ip
* 	tel
* 	date
*/
class formUser extends form
{
	function __construct($route="user_exec_create",$attr=[]){
		parent::__construct($route,$attr);
		
		$this->setId("FORM_ID"); // id du formulaire
		$this->setRoute("FORM_ROUTE");	// route du formulaire

		$this->setAppMsg("FORM_APP_MSG");// source des messages
		$this->setLabelShow("TRUE_FALSE_PLACEHOLDER"); // label true false ou placeholder
		
		$this->setAttr([
			"class"=>"FORM_CLASS",
			"FORM_ATTR"=>"FORM_ATTR_VALUE"
		]);
		/* CONTROL LIST */
		$this->setControl([
			"ITEM_NAME" => [
				"req"=>true,
				"min"=>3,
				"max"=>15,
				"equal" => "UserPassword",
				"date"=>true,
				"tel"=>true
			]
		]);


		$this->setExemple([
			"ITEM_NAME" => "EXEMPLE_1",
			"ITEM_NAME2" => [
				"EXEMPLE_1",
				"EXEMPLE_2"
			]
		]);
		
      	
      	$listValue = [
      		"VALUE1"=>$this->msg("MSG_APP","MSG_ID"),
      		"VALUE2"=>$this->msg("MSG_APP","MSG_ID")
      	];

      	// Step
		$this->step("step1");
		$this->add("ITEM_NAME","ITEM_TYPE","VALUE","OPTION","ATTR");


	}
}

 ?>