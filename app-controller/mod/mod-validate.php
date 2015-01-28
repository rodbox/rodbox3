<?php 
/*
* 
* Test les clés de $eval_data si 
* 

* $p["empty"] = array();
* $p["mail"] = array();
* $p["int"] = array();
* $p["reg"] = array();
* $p["alpha_num"] = array();
* $p["user_exist"] = array();
* $p["mail_exist"] = array();
*/
class validate extends form
{
	
	var  $error = array();
	var  $eval_data;
	var  $control;

	function validate($eval_data,$control){

		$this->eval_data = $eval_data;
		$this->control = $control;
		// $this->validate_int();
		$this->validate_mail();
		$this->validate_alpha_num();
		$this->validate_empty();
		$this->validate_user_exist();
		$this->validate_mail_exist();
		
		return $this->error;
	}

	function validate_int(){
		foreach ($this->control["int"] as $key => $keyOfData) {
			if(!is_int($this->eval_data[$keyOfData]))
				$this->error["int"][] = $keyOfData; 
		}
	}

	function validate_mail(){
		foreach ($this->control["mail"] as $key => $keyOfData) {
			$eval = filter_var($this->eval_data[$keyOfData],FILTER_VALIDATE_EMAIL);
			if(!$eval)
				$this->error["mail"][] = $keyOfData; 
		}
		
        return ($eval) ? true : false;
	}


	function validate_alpha_num(){
		foreach ($this->control["alpha_num"] as $key => $keyOfData) {
			$eval = preg_match('[^a-zA-Z0-9_]', $this->eval_data[$keyOfData]);

			if($eval)
				$this->error["alpha_num"][] = $keyOfData; 
		}
		
        return ($eval) ? true : false;
	}

	function validate_reg(){

	}

	function validate_empty(){
		foreach ($this->control["empty"] as $key => $keyOfData) {
			if($this->eval_data[$keyOfData]=="")
				$this->error["empty"][] = $keyOfData;
		}
	}



}  ?>

 ?>