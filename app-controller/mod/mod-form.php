<?php 
/**
* form Constructor
*/
class form extends controller
{
	var $id;
	var $action;
	var $method;
	var $formClass;
	var $formList = [];
	var $formAttr = [];
	var $reqList = [];	//liste les names des champs obligatoire
	var $putList = [];	//les valeurs de formulaires
	var $labelList = [];	//les valeurs des labels et des helpers
	var $tokenID;
	var $tokenTimeID;
	var $token;	//les valeurs des labels et des helpers

	function __construct($route,$attr=[]){
		$this->action 	= $this->routeExecUrl($route);
		$this->method 	= "POST";

		$this->tokenID 	= "token_".$this->id;
		$this->tokenTimeID = "token_".$this->id.'_time';
	}

	function setMethod($method){
		$this->method = $method;
	}


	function start($attrForce=[]){
		$attr=array_merge($this->formAttr,$attrForce);

		echo '<form id="'.$this->id.'" action="'.$this->action.'" method="'.$this->method.'" '.$this->attr($attr).'>';

		$this->getToken();
	}

	function end(){
		foreach ($this->formList as $keyItem => $valueItem) {
			$this->getItem($valueItem["name"]);
		}
		echo '</form>';
	}

	function req($list){
		$this->reqList = $list;
	}

	function put($list){
		$this->putList = $list;
	}

	function addLabel($list){
		$this->labelList = $list;
	}

	function add($name="",$type="text",$value="",$options="",$attr=[]){
		$this->formList[$name]=[
			"name" 	=> $name,
			"type" 	=> $type,
			"value"	=> $value,
			"options"=> $options,
			"attr" 	=> $attr
		];
	}

	function getForm(){
		$this->start();
		
		$this->end();
	}

	function getItem($name,$attrForce=""){
		$item = $this->formList[$name];
		extract($item);
		if(is_array($attrForce))
			$attr=array_merge($attr,$attrForce);
		
		
		/* Required Evaluation */
		$evalReq = in_array($name, $this->reqList);
		if($evalReq)
			$attr["required"]="required";
		
		/* si les valeurs instancier par $form->put() prenne la priorité sur les valeurs par défault */
		$evalPut = array_key_exists($name, $this->putList);
		if ($evalPut)
			$value = $this->putList[$name];
		
		$evalLabel = array_key_exists($name, $this->labelList);
		if ($evalLabel)
			$this->getLabel($name,$this->labelList[$name],$evalReq);

		switch ($type) {
			case 'text':
				$this->getText($name,$value,$attr);
				break;
			case 'textarea':
				$this->getTextarea($name,$value,$attr);
				break;
			case 'password':
				$this->getPassword($name,$value,$attr);
				break;
			case 'submit':
				$this->getSubmit($name,$value,$attr);
				break;
			case 'select':
				$this->getSelect($name,$value,$options,$attr);
				break;
			case 'radio':
				$this->getRadio($name,$value,$options,$attr);
				break;
			case 'checkbox':
				$this->getCheckbox($name,$value,$options,$attr);
				break;
			case 'range':
				$this->getRange($name,$value,$attr);
				break;
			case 'codemirror':
				$this->getCodemirror($name,$value,$attr);
				break;
			default:
				$this->getText($name,$value);
				break;
		}
		unset($this->formList[$name]);
	}

	function setAttr($attr=[]){
		$this->formAttr = $attr;
	}

	function getLabel($for,$label="",$evalReq){
		echo '<label for="'.$for.'" />';
		echo $label[0];
		echo (($evalReq)?" *":"");
		if(isset($label[1])&&$label[1]!="")
			$this->getHelper($for,$label[1]);
		echo '</label>';
	}

	function getHelper($name,$content,$placement="top"){
		echo ' <a href="#" class=" bg-transparent bt-popover" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="'.$placement.'" data-content="'.$content.'"> <i class="fa fa-question "></i> </a>';
	}

	function getText($name,$value,$attr=[]){
		echo '<input type="text" name="'.$name.'" '.$this->attr($attr).' value="'.$value.'" />';
	}

	function getHidden($name,$value,$attr=[]){
		echo '<input type="hidden" name="'.$name.'" '.$this->attr($attr).' value="'.$value.'" />';
	}

	function getPassword($name,$value,$attr=[]){
		echo '<input type="password" name="'.$name.'" '.$this->attr($attr).' value="'.$value.'" />';
	}

	function getTextarea($name,$value,$attr=[]){
		echo '<textarea name="'.$name.'" '.$this->attr($attr).'>';
		echo $value;
		echo '</textarea>';
	}
	function getCodemirror($name,$value,$attr=[]){
		// $attr["class"] = $attr["class"]." codemirror":" codemirror";
		$attr["class"] = (array_key_exists("class",$attr))? $attr["class"]." codemirror":" codemirror";
		echo '<textarea name="'.$name.'" '.$this->attr($attr).'>';
		echo $value;
		echo '</textarea>';
	}

	function getRadio($name,$value,$options){
		$i = 0;
		echo '<div class="radio-group">';
			foreach ($options as $keyOption => $valueOption) {
				$i++;
				$radioID  = $name."-".$i;
				echo '<div class="radio">';
				echo '<input type="radio" name="'.$name.'" id="'.$radioID.'" value="'.$keyOption.'" '.(($value==$keyOption)?'checked':'').' />';
				echo '<label for="'.$radioID.'" class="forradio">';
				echo $valueOption;
				echo '</label>';
				echo '</div>';
			}
		echo '</div>';
	}

	function getCheckbox($name,$value,$options){
		$i = 0;
		echo '<div class="checkbox-group">';
			foreach ($options as $keyOption => $valueOption) {
				$i++;
				$checkboxID  = $name."-".$i;
				echo '<div class="radio">';
				echo '<input type="checkbox" name="'.$name.'[]" id="'.$checkboxID.'" value="'.$keyOption.'" '.((in_array($keyOption, $value))?'checked':'').' />';
				echo '<label for="'.$checkboxID.'" class="forcheckbox">';
				echo $valueOption;
				echo '</label>';
				echo '</div>';
			}
		echo '</div>';
	}

	function getSubmit($name,$value,$attr=[]){
		echo '<input type="submit" name="" '.$this->attr($attr).' value="'.$value.'" />';
	}

	function getRange($name,$value,$attr){
		echo '<input type="range" name="'.$name.'" '.$this->attr($attr).' value="'.$value.'" />';
	}

	function getSelect($name,$value,$options,$attr=[]){
		echo '<select name="'.$name.'" '.$this->attr($attr).'>';
			foreach ($options as $keyOption => $valueOption)
				echo '<option value="'.$keyOption.'" '.(($value==$keyOption)?'selected':'').'>'.$valueOption.'</option>';
		echo '</select>';
	}


	function getNumber($name,$value,$attr=[]){
		echo '<input type="number" name="'.$name.'" '.$this->attr($attr).' value="'.$value.'" />';
	}


	function getToken(){
		$token 	=  uniqid(rand(), true);
		$this->tokenID = $tokenID = "token_".$this->id;
		$this->tokenTimeID = $tokenTimeID = "token_".$this->id.'_time';

		$_SESSION[$tokenID] = $token;
		$_SESSION[$tokenTimeID] = time();

		$this->getHidden($tokenID,$token);
	}



	function ifToken(){
		if(isset($_SESSION[$this->tokenID]) && isset($_SESSION[$this->tokenTimeID]) && isset($_POST[$this->tokenID])){
			if($_SESSION[$this->tokenID] == $_POST[$this->tokenID]){
				$timestamp_ancien = time() - (15*60);
				if($_SESSION[$this->tokenTimeID] >= $timestamp_ancien)
					return true;
			}
		}
	}

	function setId($id=""){
		$this->id = $id;
	}

	function setRoute($route=""){
		$this->action 	= $this->routeExecUrl($route);
	}
/*** END form Constructor ***/
}
?>