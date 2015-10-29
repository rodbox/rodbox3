<?php 
/*
* 
* Test les clés de $eval_data si 
* 

* $p["req"] = array();
* $p["mail"] = array();
* $p["int"] = array();
* $p["reg"] = array();
* $p["alpha_num"] = array();
* $p["min"] = array("keyname"=>x);
* $p["max"] = array("keyname"=>x);
* $p["equal"] = array("keyname"=>"keynameEqual");
* $p["url"] = array();
* $p["ip"] = array();
* $p["date"] = array();
* $p["tel"] = array(); // format fr
*/
class validate extends form
{
	
	var  $error = array();
	var  $eval_data;
	var  $control;

	function validate($eval_data,$control){
		$this->eval_data = $eval_data;
		$this->control = $control;

		foreach ($control as $ItemName => $ItemControl) {
			foreach ($ItemControl as $keyControl => $valueControl) {
				$funcName = "validate_".$keyControl;
				$this->$funcName($ItemName,$valueControl);
			}
		}
		$c = count($this->error);
		return ($c==0)?true:$this->error;
	}

	function validate_int($name,$value){
		if($this->validate_req($name)){
			if(!is_int($this->eval_data[$name]))
				$this->error[$name]["int"] = $this->getMsg("int");
		}
	}

	function validate_mail($name){
		if($this->validate_req($name)){
			$eval = filter_var($this->eval_data[$name],FILTER_VALIDATE_EMAIL);
			if(!$eval)
				$this->error[$name]["mail"] = $this->getMsg("mail"); 
		}
	}


	function validate_alpha_num($name,$value){
		if($this->validate_req($name)){
			$eval = preg_match('[^a-zA-Z0-9_]', $this->eval_data[$name]);
			if($eval)
				$this->error[$name]["alpha_num"] = $this->getMsg("alpha_num");
		}
	}

	function validate_reg($name,$regexp){
		if($this->validate_req($name)){
			$a = $this->eval_data[$name];
			if(!preg_match($regexp, $a))
				$this->error[$name]["reg"] = $this->getMsg("url",$regexp);
		}
	}

	function validate_req($name){
		if(!array_key_exists($name,$this->eval_data)||$this->eval_data[$name]==""){
			$this->error[$name]["req"] = $this->getMsg("req");
			return false;
		}
		else
			return true;
	}

	function validate_min($name,$strmin){
		if($this->validate_req($name)){
			if(strlen($this->eval_data[$name])<$strmin)
				$this->error[$name]["min"] = $this->getMsg("min",$strmin);
		}
	}

	function validate_max($name,$strmax){
		if($this->validate_req($name)){
			if(strlen($this->eval_data[$name])>$strmax){
				$this->error[$name]["max"] = $this->getMsg("max",$strmax);
			}
		}
	}

	function validate_equal($name,$equalName){
		if($this->validate_req($name)){
			if($this->eval_data[$name]!=$this->eval_data[$equalName])
				$this->error[$name]["equal"] = $this->getMsg("equal",$equalName."Label");
		}
	}


	function validate_url($name,$value){
		if($this->validate_req($name)){
			$a = $this->eval_data[$name];
			if(!filter_var($a, FILTER_VALIDATE_URL))
				$this->error[$name]["url"] = $this->getMsg("url");
		}
	}

	function validate_ip($name,$value){
		if($this->validate_req($name)){
			$a = $this->eval_data[$name];
			if(!filter_var($a, FILTER_VALIDATE_IP))
				$this->error[$name]["ip"] = $this->getMsg("ip");
		}
	}
	
	function validate_tel($name,$value){
		// if($this->validate_req($name)){
		// 	$a = $this->eval_data[$name];
		// 	if(!preg_match('`^0[1-9]([-. ]?[0-9]{2}){4}$`', $a))
		// 		$this->error[$name]["tel"] = $this->getMsg("tel");
		// }
	}

	//**si la valeur correspond a l'un des formats cela retourne true */
	function validate_date($name,$value){
		if($this->validate_req($name)){
			$a = $this->eval_data[$name];
			$error = 0;
			$eval_format = [
				"Y-m-d",
				"Y/m/d",
				"d-m-Y",
				"d/m/Y"
			];
			foreach ($eval_format as $keyFormat => $format) {
				$d = DateTime::createFromFormat($format, $a);
				if($d && $d->format($format) == $a)
					$error++;
			}
			// si tout les formats on renvoyer une erreur alors il y a une erreur.
			if($error == count($eval_format))
				$this->error[$name]["date"] = $this->getMsg("date");
		}
	}


	function getMsg($key,$value=""){
		return $this->msg("app",$key,["VALUE"=>$value]);
	}
}
?>
