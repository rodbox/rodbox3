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
class formEvent extends form
{
	function __construct($route="app_exec_event_upd",$attr=[]){
		parent::__construct($route,$attr);
		
		$this->setId("event"); // id du formulaire
		$this->setRoute("app_exec_event_upd");	// route du formulaire

		$this->setAppMsg("app");// source des messages
		$this->setLabelShow(true); // label true false ou placeholder
		
		$this->setAttr([
			"class"=>"appliveform"
		]);
		// /* CONTROL LIST */
		// $this->setControl([
		// 	"ITEM_NAME" => [
		// 		"req"=>true,
		// 		"min"=>3,
		// 		"max"=>15,
		// 		"equal" => "UserPassword",
		// 		"date"=>true,
		// 		"tel"=>true
		// 	]
		// ]);


		// $this->setExemple([
		// 	"ITEM_NAME" => "EXEMPLE_1",
		// 	"ITEM_NAME2" => [
		// 		"EXEMPLE_1",
		// 		"EXEMPLE_2"
		// 	]
		// ]);
		
      	
      	// $listValue = [
      	// 	"VALUE1"=>$this->msg("MSG_APP","MSG_ID"),
      	// 	"VALUE2"=>$this->msg("MSG_APP","MSG_ID")
      	// ];

      	// Step
		$this->step("step1");
		$this->add("title","text");
		$this->add("description","textarea");
		$this->add("start","date");
		$this->add("startTime","time");
		$this->add("end","date");
		$this->add("endTime","time");
		$this->add("type","select","",["","perso"=>"perso","project"=>"project"]);
		$this->add("submitEvent","submit","Enregistrer","",["class"=>"bg-2 c-7 no-border w-100 pad-5"]);



	}
}

 ?>