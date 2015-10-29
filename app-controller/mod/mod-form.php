<?php 
/**
* form Constructor
*/
class form extends controller
{
	var $id;
	var $action;
	var $method;
	var $appMsg;
	var $step;

	var $formClass;
	var $formList = [];
	var $formListByStep = [];	// les noms de champs par step
	var $formAttr = [];

	var $putList = [];	//les valeurs de formulaires
	var $errorList = [];	//les erreurs de valeur de formulaires
	var $controlList = [];	//les controles de validations du formulaire
	var $stepTitle = [];	//les steps

	var $exempleList = [];	//les valeurs des labels et des helpers
	var $tokenID;
	var $tokenTimeID;
	var $labelShow = true; // true|false|placeholder
	var $token;	//les valeurs des labels et des helpers

	function __construct($route,$attr=[]){
		$this->action 	= $this->routeExecUrl($route);
		$this->method 	= "POST";

		$this->tokenID 	= "token_".$this->id;
		$this->tokenTimeID = "token_".$this->id.'_time';
		$this->step 	= 0;
	}

	function setMethod($method){
		$this->method = $method;
	}


	function start($attrForce=[]){
		$attr=array_merge($this->formAttr,$attrForce);

		echo '<form id="'.$this->id.'" action="'.$this->action.'" method="'.$this->method.'" '.$this->attr($attr).'>';

		$this->getErrorForm();
		$this->getToken();
	}

	function end(){
		foreach ($this->formList as $keyItem => $valueItem) {
			$this->getItem($valueItem["name"],$valueItem["attr"],true);
		}
		echo '</form>';
	}


	function put($list){
		$this->putList = $list;
	}

	function add($name="",$type="text",$value="",$options="",$attr=[]){
		$this->formList[$name]=[
			"name" 	=> $name,
			"type" 	=> $type,
			"value"	=> $value,
			"options"=> $options,
			"attr" 	=> $attr,
			"step"	=> $this->step
		];
		//** list name by Step
		$this->formListByStep[$this->step][]=$name;
	}

	function step($stepTitle=""){
		$this->step++;
		$this->stepTitle[$this->step] = $stepTitle;
		

	}

	function getForm(){
		$this->start();
		
		$this->end();
	}

	function getFormByStep($cur = 1){
		// on commence le formulaire
		$this->start();
		// on affiche le header (vue de la navigation courrante)
		$this->getStepHeader($cur);

		// on crée les step
		echo '<div class="form-step-container">';
		for ($i=1; $i <= $this->step; $i++) { 
			$this->getStepStart($i,$cur);
			foreach ($this->formListByStep[$i] as $keyItem => $nameItem) {

				$item = $this->formList[$nameItem];
				if($item["type"]!="submit")
					$this->getItem($item["name"],$item["attr"],$this->labelShow);
				else
					$this->submitValue  = $item["name"];
			}
			// rajoute les boutons de navigation
			$this->getStepEnd($i);
		}
		echo "<div>";
		// on termine le formulaire
		echo '</form>';
	}

	function getStepHeader($cur){
		echo '<div class="form-step-header">';
			echo '<ul class="form-step-list">';
			for ($i=1; $i <= $this->step; $i++) {
				$stepID = $this->id."-step-".$i;
				$stepIDHeader = $stepID."-header";
				if($this->stepTitle[$i]!=""){
					$titleStep = $this->msg($this->appMsg,$this->stepTitle[$i]);
					$metaPopover = ' data-placement="top" data-toggle="popover" data-trigger="click" data-container=".form-step-header" data-content="'.$titleStep.'" data-original-title="" title="" ';
				}
				else{
					$metaPopover="";
				}
				echo '<li id="'.$stepIDHeader.'" class="'.(($i==$cur)?'form-step-current':'').'"><a href="#'.$stepID.'" '.$metaPopover.' class="step-popover">'.$i.'</a></li>';
			}
			echo "</ul>";
		echo "</div>";
	}

	function getStepStart($step,$cur){
		$stepID = $this->id."-step-".$step;
		$titleStep = $this->msg($this->appMsg,$this->stepTitle[$step]);
		echo '<div id="'.$stepID.'" class="form-step-body '.(($step==$cur)?'form-step-current':'').'">';
		// echo '<h2 class="form-step-title">'.$titleStep.'</h2>';
	}

	function getStepEnd($step){
		$stepID = $this->id."-step-";
		if($this->stepTitle[$step]!=""){

		}

		echo '<div class="form-step-footer">';
			/* Bouton prev si step > 1*/
			if($step>1){
				$titleStepPrev = $this->msg($this->appMsg,$this->stepTitle[$step-1]);
				echo "<a href='#".$stepID.($step-1)."' class='form-step-button form-step-button-prev btn'>";
					echo '<span class="title"><i class="icomoon-arrow-left2"></i> '.$this->msg("app","prevStep",["VALUE"=>($step-1)]).'</span>';
					echo '<span class="sub-title">'.$titleStepPrev.'</span>';
				echo "</a>";
			}
			/* Bouton next si step < 1*/
			if($step<$this->step){
				$titleStepNext = $this->msg($this->appMsg,$this->stepTitle[$step+1]);
				echo "<a href='#".$stepID.($step+1)."' class='form-step-button form-step-button-next btn'>";
					echo '<span class="title">'.$this->msg("app","nextStep",["VALUE"=>($step+1)]).' <i class="icomoon-arrow-right2"></i></span>';
					echo '<span class="sub-title">'.$titleStepNext.'</span>';
				echo "</a>";
			}

			else {
				echo "<button class='form-step-button-submit btn'>";
					echo '<span class="title">'.$this->msg($this->appMsg,$this->submitValue).'</span>';
					echo '<span class="sub-title">'.$this->msg($this->appMsg,$this->id).'</span>';
				echo "</button>";
			}
		echo "</div>";
		
		// fermeture de step
		echo "</div>";
	}

	/**
	 * Affiche un champ depuis son name
	 * @param  string  $name      [description]
	 * @param  array  $attrForce  attribut HTML5
	 * @param  boolean $label     true|false|placeholder
	 * @return echo item             [description]
	 */
	function getItem($name,$attrForce="",$labelShow=true){
		$item = $this->formList[$name];
		extract($item);

		/* On merge les attributs par défautl et ce definit a l'integration */
		if(is_array($attrForce))
			$attr=array_merge($attr,$attrForce);

		/* si les valeurs instancier par $form->put() prenne la priorité sur les valeurs par défault */
		$evalPut = array_key_exists($name, $this->putList);
		if ($evalPut)
			$value = $this->putList[$name];


		/* Debut du item */
		$this->getItemStart($name,$attr,$type,$value);

		$attrValidate = $this->getAttrValidate($name);

		$attr=array_merge($attr,$attrValidate);


		/* Required Evaluation */
		if(array_key_exists($name,$this->controlList))
			$evalReq = array_key_exists("req", $this->controlList[$name]);
		else
			$evalReq = false;

		// if($labelShow=="placeholder")
			// $attr["placeholder"] = $this->msg($this->appMsg,$name."Label").(($evalReq)?" *":"");


		// if($evalReq)
		// 	$attr["required"]="required";
		// /* END Required Evaluation */

		
		
		if($type!='hidden')
			$this->getLabel($name,$evalReq,$labelShow);

		switch ($type) {
			case 'text':
				$this->getText($name,$value,$attr);
				break;
			case 'date':
				$this->getDate($name,$value,$attr);
				break;
			case 'time':
				$this->getTime($name,$value,$attr);
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
			case 'hidden':
				$this->getHidden($name,$value,$attr);
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
				$this->getText($name,$value,$attr);
				break;
		}

			// $this->getError($name);
		$this->getItemEnd();

		unset($this->formList[$name]);
	}

	function getItemStart($name,$attr="",$type="text",$value="text"){
		// item
		$classAlert = (array_key_exists($name,$this->errorList))? "form-item-alert":"";
		$classEmpty = ($value=="")?"form-item-empty":"";
		echo '<span id="item-'.$name.'" class="form-item '.$classAlert.' form-item-'.$type.' '.$classEmpty.'">';
	}

	function getItemEnd(){
		// end item-content
		echo "</span>";
	}

	function setAttr($attr=[]){
		$this->formAttr = $attr;
	}

	function getAttrValidate($name){
		$attr = [];

		/* List les controles Itemname */
		if(array_key_exists($name,$this->controlList)){
			$attr["class"] = " validate ";
			foreach ($this->controlList[$name] as $validate => $valueValidate) {
				$attr["class"]		.=" validate-".$validate." ";
				$evalList[] = $validate;
				/* Pour les attribus spéciaux html5 ou avec des valeurs de comparaisons définit */
				switch ($validate) {
					case 'req':
						// Start REQ
						$attr["required"]="required";
						// end REQ
						break;
					case 'min':
						// Start MIN
						$attr["min"]=$valueValidate;
						$attr["data-min"]=$valueValidate;
						break;
					case 'max':
						// Start MAX
						$attr["max"]=$valueValidate;
						$attr["data-max"]=$valueValidate;
						// end MAX
						break;
					case 'equal':
						// Start EQUAL
						$attr["data-equal"]	= $valueValidate;
						// end EQUAL
						break;
				}

				$attr["data-validate"]		= implode("|",$evalList);
			}
			/* LOG validate in input for jquery */
			// $this->log("validate in input for jquery",__FILE__,);
			/* END LOG validate in input for jquery */
			// $evalReq = array_key_exists("req", $this->controlList[$name]);
		}

		return $attr;
	}

	function setExemple($exemple){
		$this->exempleList = $exemple;
	}

	function getLabel($for,$evalReq,$labelForce=true){

		$label = $this->msg($this->appMsg,$for."Label");
			if ($label!="") {
				echo '<label for="'.$for.'" class="form-item-label" >';
				echo $label;
				echo (($evalReq)?" *":"");
				echo '</label>';
			}
			$this->getHelperControl($for);
	}

	function getHelperControl($name){
		if(array_key_exists($name,$this->controlList)){
			$helper = "<ul class='no-pad no-marg'>";
			foreach ($this->controlList[$name] as $key => $value) {
				if($key=="equal")
					$value = $this->msg($this->app,$value."Label");
				$helper .= "<li>";
				$helper .= $this->msg("app",$key,["VALUE"=>$value]);
				$helper .= "</li>";
			}

			if(array_key_exists($name,$this->exempleList)){
				// si il y a plusieurs exemples
				if(is_array($this->exempleList[$name])){
					$helper .= "<hr class='no-pad margv-3'>";
					foreach ($this->exempleList[$name] as $keyExemple => $valueExemple) {
						$helper .= "<li>";
						$helper .= "ex ".($keyExemple+1)." : <strong>";
						$helper .= $valueExemple;
						$helper .= "</strong></li>";
					}
				}
				// sinon il n'y en a qu'un
				else{
					$helper .= "<li>";
					$helper .= "<hr class='no-pad margv-3'>";
					$helper .= "ex : <strong>";
					$helper .= $this->exempleList[$name];
					$helper .= "</strong></li>";
				}
			}

			$helper .= "</ul>";
			$this->getHelper($name,$helper,"right");
		}
	}



	function getHelper($name,$content,$placement="top"){
		echo ' <a href="#" class=" bg-transparent bt-popover" data-container="body" data-trigger="hover | focus " data-toggle="popover" data-placement="'.$placement.'" data-content="'.$content.'"> <i class="icomoon-question4   "></i> </a>';
	}

	function getText($name,$value,$attr=[]){
		echo '<input type="text" name="'.$name.'" id="'.$name.'" '.$this->attr($attr).' value="'.$value.'" />';
	}

	function getDate($name,$value,$attr=[]){
		echo '<input type="date" name="'.$name.'" id="'.$name.'" '.$this->attr($attr).' value="'.$value.'" />';
	}

	function getHidden($name,$value,$attr=[]){
		echo '<input type="hidden" name="'.$name.'" id="'.$name.'" '.$this->attr($attr).' value="'.$value.'" />';
	}

	function getPassword($name,$value,$attr=[]){
		echo '<input type="password" name="'.$name.'" id="'.$name.'" '.$this->attr($attr).' value="'.$value.'" />';
	}

	function getTextarea($name,$value,$attr=[]){
		echo '<textarea name="'.$name.'" id="'.$name.'" '.$this->attr($attr).'>';
		echo $value;
		echo '</textarea>';
	}
	function getCodemirror($name,$value,$attr=[]){
		// $attr["class"] = $attr["class"]." codemirror":" codemirror";
		$attr["class"] = (array_key_exists("class",$attr))? $attr["class"]." codemirror":" codemirror";
		echo '<textarea name="'.$name.'" id="'.$name.'" '.$this->attr($attr).'>';
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
				echo '<input type="radio" name="'.$name.'"  id="'.$radioID.'" value="'.$keyOption.'" '.(($value==$keyOption)?'checked':'').' />';
				echo '<label for="'.$radioID.'" class="forradio">';
				echo $valueOption;
				echo '</label>';
				echo '</div>';
			}
		echo '</div>';
	}

	function getCheckbox($name,$value,$options){
		/* LOG checkbox value */
		$this->log("checkbox value BEFORE",__FILE__,$value);
		/* END LOG checkbox value */

		if(!is_array($value))
			$value = json_decode($value,true);
/* LOG checkbox value */
		$this->log("checkbox value AFTER",__FILE__,$value);
		/* END LOG checkbox value */
		$i = 0;
		echo '<div class="checkbox-group">';
			foreach ($options as $keyOption => $valueOption) {
				$i++;
				$checkboxID  = $name."-".$i;
				echo '<div class="checkbox">';
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
		echo '<input type="range" name="'.$name.'" id="'.$name.'" '.$this->attr($attr).' value="'.$value.'" />';
	}

	function getSelect($name,$value,$options,$attr=[]){
		echo '<select name="'.$name.'" id="'.$name.'" '.$this->attr($attr).'>';
			foreach ($options as $keyOption => $valueOption)
				echo '<option value="'.$keyOption.'" '.(($value==$keyOption)?'selected':'').'>'.$valueOption.'</option>';
		echo '</select>';
	}


	function getTime($name,$value="12:00",$options="",$attr=[]){
		$time = explode(":",$value);
		echo '<select name="'.$name.'["hours"]" id="'.$name.'-hours" '.$this->attr($attr).'>';

		for ($hour=0; $hour < 24; $hour++) { 
			$hourFill = str_pad((string)$hour, 2, "0", STR_PAD_LEFT);
			echo '<option value="'.$hourFill.'" '.(($hourFill==$time[0])?'selected':'').'>'.$hourFill.'</option>';
		}
		echo '</select>';
		echo ' : ';

		echo '<select name="'.$name.'["min"]" id="'.$name.'-min" '.$this->attr($attr).'>';
			for ($minute=0; $minute < 60; $minute++) { 
				$minuteFill = str_pad((string)$minute, 2, "0", STR_PAD_LEFT);
			echo '<option value="'.$minuteFill.'" '.(($minuteFill==$time[1])?'selected':'').'>'.$minuteFill.'</option>';
			}
		echo '</select>';
	}


	function getNumber($name,$value,$attr=[]){
		echo '<input type="number" name="'.$name.'" id="'.$name.'" '.$this->attr($attr).' value="'.$value.'" />';
	}

	function getError($name,$attr=[]){
		$error = (array_key_exists($name,$this->errorList))? $this->errorList[$name]:[];
		$attr["class"] = (array_key_exists("class",$attr))? $attr["class"]." form-alert-item":" form-alert-item";
		echo '<div id="'.$name.'-alert" '.$this->attr($attr).' >';
			echo '<ul class="no-pad no-marg">';
			if(count($error)>0){
				foreach ($error as $key => $value) {
					echo "<li>";
					echo $this->msg("app",$key,["VALUE"=>$value]);
					echo "</li>";
				}
			}
			echo '</ul>';
		echo '</div>';
	}

	function getErrorForm($attr=[]){
		if(count($this->errorList)>0)
		$attr["class"] = (array_key_exists("class",$attr))? $attr["class"]." form-alert":" form-alert";
		echo '<div id="form-alert" '.$this->attr($attr).'>';
		echo '<ul class="no-pad">';
			foreach ($this->errorList as $itemName => $itemErrorList) {
					echo "<li>";
						$linkContent = $itemName." : ".implode(",",$itemErrorList);
						$itemLabel = $this->msg($this->appMsg,$itemName."Label");
						$this->getTargetFocus($itemName,$itemLabel . " :");
						echo "<ul class='padh-5'>";

						foreach ($itemErrorList as $Errorkey => $errorValue) {
							echo "<li>";
							echo $this->msg("app",$Errorkey,["VALUE"=>$errorValue]);
							echo "<li>";
						}

						echo "</ul>";

					echo "</li>";
				}
		echo '</ul>';
		echo '</div>';
	}

	function getToken(){
		$token 	=  uniqid(rand(), true);
		$this->tokenID = $tokenID = "token_".$this->id;
		$this->tokenTimeID = $tokenTimeID = "token_".$this->id.'_time';

		$_SESSION[$tokenID] = $token;
		$_SESSION[$tokenTimeID] = time();

		$this->getHidden($tokenID,$token);
	}

	function getTargetFocus($name,$value){
		echo '<a href="#" class="target-focus" data-focus="'.$name.'">';
		echo $value;
		echo '</a>';
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

	function setAppMsg($app="app"){
		$this->appMsg = $app;
	}

	function setRoute($route=""){
		$this->action 	= $this->routeExecUrl($route);
	}

	function setControl($dataControl){
		$this->controlList = $dataControl;
	}

	function setLabelShow($labelShow){
		$this->labelShow = $labelShow;
	}

	function getControle(){
		return $this->controlList;
	}
/*** END form Constructor ***/

	function validate($dataFormPost=""){
		$dataFormPost = ($dataFormPost=="")?$_POST:$dataFormPost;
		$this->mod("validate");

		$control = $this->controlList;

		$validate = new validate($dataFormPost,$this->controlList);

		$c = count($validate->error);

		$this->errorList = $validate->error;

		/* LOG validate in form class */
		$this->log("validate in form class",__FILE__,$c);
		/* END LOG validate in form class */
		
		return ($c==0)?true:$validate->error;		

		// return ($c==0)?true:$validate->error;
	
	}



}
?>