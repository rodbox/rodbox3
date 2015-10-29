<?php 

include("app-config.php");
include("app-autoload.php");
$loader = require_once DIR_COMPOSER_AUTOLOAD;
// include("../bootstrap.php");

/**
* 
*/
class controller
{
	var $app; // l'app en cours
	var $config; // config de l'app
	var $routing; // listes des routes
	var $services; // listes des services
	var $sr; // service return;
	var $data = array(); // data du model transmit a la view
  	var $dataSend = array(); // data de la method envoyé au model

	function __construct(){
		
		// definition de la route par défault si l'utilisateur et connecter ou non.
		$route = isset($_GET["route"])?$_GET["route"]:"user_page_login";
		

		$this->route = $route;
		$this->loadRouting(); // routing kernel

		$secure = $this->secureRoute($route);

		if($secure){
			$this->loadServices(); // service kernel
			

			if(isset($this->routing[$route])){
				$this->autoload = new appAutoload($route);
				$dataRoute = $this->routing[$route];

				$this->app = $dataRoute[0];

				if($dataRoute[2]=="page")
					$this->page = $dataRoute[1];
				else
					$this->exec = $dataRoute[1];

				$this->loadConfig(); // fichier config de l'app;

			}
			else{
				$this->setFlash("La route n'existe pas","error");
				$this->headerRoute("app_page_index");
			}
		}
		else{
			if($this->isUser()){
				$this->setFlash("vous n'avez pas les droits necessaires");
				$this->headerRoute("app_page_index");
			}
			else
				$this->headerRoute("user_page_login");
		}
		
	}


	/*
	* function set
	* envois le contenue d'un model enregister dans la variable $d
	*/
	function set($d){
	     $this->data = array();
	     $this->data = array_merge($this->data,$d);//contenue de la variable passer du model a la vue
	}
	function setSend($dSend){
	    $this->dataSend = array();
		$this->dataSend = array_merge($this->dataSend,$dSend);//contenue de la variable passer du model a la vue
	}

	function view($app,$view,$model="",$data=""){
		$c 		= $this;
	  if($model!=""){
	    $send = $data;
	    $this->model($app,$model,$data);
	    $d = $this->data;
	  }
	  else {
	    $d = $data;
	  }
	  echo (DEBUG_MODE)?"\n\n<!-- VIEW : $app,$view,$model -->\n":"";
	  $viewFile = DIR_APP."/".$app."/views/".$view.".php";
	  
	  $eval 	= include($viewFile);
	  echo ($eval)?"": "La view '".$app."/".$view."' n'existe pas.";
	  echo (DEBUG_MODE)?"\n\n<!-- END OF VIEW : $app,$view,$model -->\n\n":"";
	}

	function model($app,$model="",$data=""){
	  $c 		= $this;
	  $model 	= DIR_APP . "/".$app."/models/".$model.".php";
	  $send		= $data;
	  $eval 	= include($model);

	  if(!$eval)
	  	self::error("le model n'existe pas.");

	  (isset($d))?$this->set($d):"";

	  return $d;

	}
  
	function form($app,$form,$route="",$attr=[]){
		require_once(DIR_APP."/".$app."/form/".$form.".php");

  		return new $form($route,$attr);
	}
  
	function setApp($app){
		$this->app = $app;
	}
	
	function getApp(){
  		return $this->app;
	}

	function page(){
		$c = $this;
		include(DIR_APP."/".$this->app."/pages/".$this->page.".php");
	}

	function quicksidebar(){
  		$this->view("app","quicksidebar");
	}
/** GESTION DE VALIDATION DE FONCTION **/
/* rajouter une gestion des return */
	function success($msg=""){
		return ["r"=>true,"msg"=>$msg];
	}

	function error($msg=""){
		return ["r"=>false,"msg"=>$msg];
	}

	function info($msg=""){
		return ["r"=>true,"msg"=>$msg];
	}
/** END GESTION DE VALIDATION DE FONCTION **/

	function execUrl($app,$exec,$send="",$return=false){
		$q = ($send!="")?"&amp;".http_build_query($send, '', '&amp;'):"";
		$url = WEB_EXEC."?app=".$app."&amp;exec=".$exec.$q;
		if($return)
			return $url;
		else
			echo $url;
	}

	function pageUrl($app,$page="index",$send="",$return=false){
		$q = ($send!="")?"&amp;".http_build_query($send, '', '&amp;'):"";
		$url = WEB_PAGE."?app=".$app."&amp;page=index=".$page=index.$q;
		if($return)
			return $url;
		else
			echo $url;
	}


	function routePage($route,$value="",$send="",$attr=[],$return=false){
		$q = ($send!="")?"&".http_build_query($send, '', '&'):"";
		$url = WEB_PAGE_REWRITE."/web/?route=".$route.$q;

		$link = '<a href="'.$url.'" '.$this->attr($attr).'>'.$value.'</a>';

		if($return)
			return $link;
		else
			echo $link;
	}

	function routeExec($route,$value="",$send="",$attr=[],$return=false){
		$q = ($send!="")?"&amp;".http_build_query($send, '', '&amp;'):"";
		$url = WEB_APP."/app-exec.php?route=".$route.$q;

		$link = '<a href="'.$url.'" '.$this->attr($attr).'>'.$value.'</a>';

		if($return)
			return $link;
		else
			echo $link;
	}

	function routeView($app,$view,$value="",$send="",$attr=[],$return=false){
		$q = ($send!="")?"&amp;".http_build_query($send, '', '&amp;'):"";
		$url = WEB_APP."/app-view.php?app=".$app."&view=".$view.$q;

		$link = '<a href="'.$url.'" '.$this->attr($attr).'>'.$value.'</a>';

		if($return)
			return $link;
		else
			echo $link;
	}

	function routePageUrl($route,$send="",$return=true){
		$q = ($send!="")?"&amp;".http_build_query($send, '', '&amp;'):"";
		$url = WEB_PAGE_REWRITE."/web/?route=".$route.$q;

		if($return)
			return $url;
		else
			echo $url;
	}
	function routeExecUrl($route,$send="",$return=true){
		$q = ($send!="")?"&amp;".http_build_query($send, '', '&amp;'):"";
		$url = WEB_APP."/app-exec.php?route=".$route.$q;

		if($return)
			return $url;
		else
			echo $url;
	}

	function headerRoute($route,$send=""){
		$url = $this->routePageUrl($route,$send);
		header("Location:".$url);
	}

	function infoRoute($route){
		return $this->routing[$route];
	}

	function incRoute($route,$d=[]){
		$incRoute = $this->routing[$route];

		$type = $incRoute[2];

		if($type=="page")
			$folder = "pages";
		else if ($type=="view")
			$folder = "views";
		else
			$folder = $type;

		$dirRoute = DIR_APP."/".$incRoute[0]."/".$folder."/".$incRoute[1].".php";

		if(file_exists($dirRoute)){
			$c = $this;
			$appAutoload =  new appAutoload;
			include($dirRoute);

			return (isset($r)?$r:"");
		}
		else
			trigger_error("Erreur dans de coordonnée de la route : ". $route);
	}


	function getEntity($app,$entity){
		$dirEntity = DIR_APP."/".$app."/entity/".$entity.".php";
		if(file_exists($dirEntity)){
			$c = $this;
			require_once($dirEntity);

		}
		else
			trigger_error("Erreur dans de coordonnée de l' entity : ". $app."/".$entity);
	}

	function dirRoute($route){
		$incRoute = $this->routing[$route];
		$type = ($incRoute[2]=="page")?"pages":$incRoute[2];
		$dirRoute = "/app/".$incRoute[0]."/".$incRoute[2]."/".$incRoute[1].".php";
		return $dirRoute;
	}

	function dirController($app,$controller=""){
		$dirAppController = "/app/".$app."/".$controller.".php";
		return $dirAppController;
	}

	function getEM(){
		require(DIR_ENTITY_MANAGER);
		return $entityManager;
	}
    function mod($name){
        require_once(DIR_MOD.'/mod-'.$name.'.php');
    }
	function header(){
		$c = $this;
		$this->view("app","header");
	}
	function menu(){
		$c = $this;
		$this->view($this->app,"menu-right");
	}
	function metaIOS(){
		$c = $this;
		$this->view("app","meta-ios");
	}
	function title(){
		echo TITLE_PREFIX.$this->config[$this->route]["title"];
	}

	/**
	 * [service description]
	 * @param  string $service nom du service reférencé
	 * @param  string $param   [description]
	 * @return [type]          [description]
	 */
	function service($service,$param="",$param2="",$param3="",$param4=""){
		$this->loadServices();

		if(isset($this->services[$service."Service"])){


			$serviceInfo = $this->services[$service."Service"];

			$app 		= $serviceInfo[0];
			$controller	= $serviceInfo[1];
			$method		= $serviceInfo[2];

			$dirService = DIR_APP."/".$app."/".$controller.".php";
			if(file_exists($dirService)){
				require_once($dirService);
				$service 	= new $controller();
				$this->sr 	=  $service->$method($param,$param2,$param3,$param4);
				return $this->sr;
			}
			else{
				trigger_error("Problème de chargement du service");
			}
		}
		else{
			trigger_error("Le service n'est pas référencé");
		}
	}

	function loadConfig(){
		$configAppDIR = DIR_APP."/".$this->app."/config/config.json";
		$this->config =  $this->getJson($configAppDIR);
	}

	function loadServices(){
		$this->services =  $this->getJson(DIR_SERVICES);
	}

	function loadRouting(){
		$this->routing =  $this->getJson(DIR_ROUTING);
	}


	/** Retourne un message du fichier message dans la langue de l'utilisateur
	 Si le message n'existe pas dans la langue ou que le fichier de la langue n'existe pas on utilise le fichier de langue par défaut.
	 * @param  [string] $app   app du fichier
	 * @param  [string] $id    id du msg
	 * @param  [array] $param [description]
	 * @return [string]        [description]
	 */
	function msg($app,$id,$param=""){
		$msgAppDIR_LANG_CUR = DIR_APP."/".$app."/msg/".LANG.".json";
		$msgAppDIR_LANG_PRINCIPAL = DIR_APP."/".$app."/msg/".LANG_PRINCIPAL.".json";

		$msg_CUR = (file_exists($msgAppDIR_LANG_CUR))?$this->getJson($msgAppDIR_LANG_CUR):[];
		$msg_PRINCIPAL = $this->getJson($msgAppDIR_LANG_PRINCIPAL);

		if (array_key_exists($id,$msg_CUR))
			$msg = $msg_CUR[$id];
		elseif (array_key_exists($id,$msg_PRINCIPAL))
			$msg = $msg_PRINCIPAL[$id];
		else 
			$msg =  "";


		$msgReplace = $this->keyReplace($param,$msg);

		return $msgReplace ;
	}

	function help($content="",$placement="top"){
		echo ' <a href="#" class=" bg-transparent bt-popover" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="'.$placement.'" data-content="'.$content.'"> <i class="fa fa-question "></i> </a>';
	}

	function attr($attr){
		$r = "";
		foreach ($attr as $key => $value)
			$r .= $key.'="'.$value.'" ';
		return $r;
	}
	function em(){
		return new entityManager;
	}

	function getJson($dirJson){
      if(file_exists($dirJson))
		return json_decode(file_get_contents($dirJson), true);
      else
         return ["LE FICHIER N'EXISTE PAS"];
	}

	function setJson($dirJson,$arrayToJson){
		file_put_contents($dirJson,json_encode($arrayToJson,JSON_PRETTY_PRINT));
	}

	
	function keyReplace($data, $content) {
		if (is_array($data)) {
			foreach ($data as $key => $val) {
	            $find[] = "[" . $key . "]";
	            $replace[] = $val;
	        }
	        $content = str_replace($find, $replace, $content);
		}

        return $content;
    }

    function log($id,$file="",$array=""){
    	$NewLine = "-------------------------------------------------------------------------\n";
    	$NewLine .= $id." \n\n";
    	$NewLine .= date("H:i:s d-m-Y")."\n\n";
    	$NewLine .= $file;
    	$NewLine .= "\n-------------------------------------------------------------------------\n\n";
       	$NewLine .= json_encode($array,JSON_PRETTY_PRINT) ."\n";
       	$NewLine .= "\n-------------------------------------------------------------------------\n";
    	$NewLine .= "END ".$id." - ". $file;
    	$NewLine .= "\n-------------------------------------------------------------------------\n";
    	$NewLine .= "#########################################################################\n\n";

    	$logFile = file_get_contents(DIR_LOG);
    	file_put_contents(DIR_LOG, $NewLine.$logFile,LOCK_EX);
    }


    function secureRoute($route){

    	// si il n'y a pas de role attribuer alors c'est FREE
    	if (!isset($this->routing[$route][3])||in_array("FREE", $this->routing[$route][3])) {
    		return true;
    	}
    	else{
    		$secureRoute = $this->routing[$route][3];

	    	$roleList = [
				"FREE"	=> ["FREE"],
				"USER"	=> ["USER","FREE"],
				"EDITOR"=> ["EDITOR","USER","FREE"],
				"GRAPH"	=> ["GRAPH","USER","FREE"],
				"ADMIN"	=> ["ADMIN","EDITOR","GRAPH","USER","FREE"],
				"MASTER"=> ["MASTER","ADMIN","EDITOR","GRAPH","USER","FREE"]
			];
	    	
			if ($this->isUser() && $secureRoute !="FREE") {
		    	$userRole = $_SESSION["user"]["role"];

		    	foreach ($roleList[$userRole] as $key => $value) {
					$eval = in_array($value, $secureRoute);
					if($eval)
						return true;
				}
			}
			elseif($secureRoute == "FREE")
				return true;
			else
				return false;

    	}
    	
    }

    function isRole($roleReq){
    	if ($this->isUser() && $roleReq !="FREE") {
    	   	$userRole = $_SESSION["user"]["role"];
			/* La liste des roles (a déplacer)é */
			$roleList = [
				"FREE"	=> ["FREE"],
				"USER"	=> ["USER","FREE"],
				"EDITOR"=> ["EDITOR","USER","FREE"],
				"GRAPH" => ["GRAPH","USER","FREE"],
				"ADMIN"	=> ["ADMIN","EDITOR","GRAPH","USER","FREE"],
				"MASTER"=> ["MASTER","ADMIN","EDITOR","GRAPH","USER","FREE"]
			];

		/*retourne si le role de l'utilisateur en cour ce trouve dans la branche autoriser */
		return in_array($roleReq, $roleList[$userRole]);
		}
		else{
			return true;
		}
		// }
		// else
		// 	return false;
    }

    function isUser(){
    	return isset($_SESSION["user"]);
    }

    function setFlash($msg,$type="info"){
    	$_SESSION["flash"][]=["msg"=>$msg,"type"=>$type];
    }

    function getFlash(){
    	if (isset($_SESSION["flash"])>0) {
	    	foreach ($_SESSION["flash"] as $key => $value) {
	    		echo "<li class='flash flash-".$value["type"]."'>";
	    		echo "<a href='#' class='pull-right c-7 close-flash' >X</a>";
	    		echo "<p>".$value["msg"]."</p>";
	    		echo "</li>";
	    	}
    	}
    	unset($_SESSION["flash"]);
    }

   function flag($flag="EN",$return=true){
   	$img = '<img src="'.WEB_FLAGS.'/'.$flag.'.png" class="flag" name="" />';
   	if($return)
   		return $img;
   	else
   		echo $img;
   }

   function saveRouting(){
   		copy(DIR_ROUTING,DIR_SAVE."/config/routing/routing_".date("Y_m_d___H-i-s").".json");
   }

   function saveServices(){
   		copy(DIR_SERVICES,DIR_SAVE."/config/services/services_".date("Y_m_d___H-i-s").".json");
   }

   function saveMsg($app,$lang="FR"){
   		$src = DIR_APP."/".$app."/msg/".$lang.".json";
   		$dest = DIR_SAVE."/".$app."/msg/".$lang."_".date("Y_m_d___H-i-s").".json";

   		if(!file_exists(DIR_SAVE."/".$app)){
   			mkdir(DIR_SAVE."/".$app);
   			mkdir(DIR_SAVE."/".$app."/msg");
   		}
   		copy($src,$dest);
   }
   	function img($app,$imgFile,$attr=[]){
		echo '<img src="'.WEB_APP.'/'.$app.'/img/'.$imgFile.'" '.$this->attr($attr).' />';
	}

}
class_alias('controller', 'app');
?>