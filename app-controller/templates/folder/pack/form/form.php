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
class form[APPUPPER] extends form
{
	function __construct($route="[APP]_exec_save",$attr=[]){
		parent::__construct($route,$attr);
		
		$this->setId("form[APPUPPER]"); // id du formulaire
		$this->setRoute($route);	// route du formulaire

		$this->setAppMsg("[APP]");// source des messages
		$this->setLabelShow("placeholder"); // label true false ou placeholder
		
		$this->setAttr([
			"class"=>"FORM_CLASS"
		]);
		/* CONTROL LIST */
		$this->setControl([
			"[APP]" => [
				"req"=>true,
				"min"=>3,
				"max"=>15,
				"equal" => "",
				"date"=>true,
				"tel"=>true
			]
		]);


		$this->setExemple([
			"[APP]" => "EXEMPLE_1",
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
		$this->add("[APP]","text","[APP]",[],[]);


	}
}

 ?>