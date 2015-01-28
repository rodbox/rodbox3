<?php 
session_start();
include("app-config.php");
include("autoload.php");
/**
* 
*/
class controller
{
	var $app;
	var $config;
	var $routing;
	var $services;
	var $data = array();
  	var $dataSend = array();


	function __construct(){
		$route = isset($_GET["route"])?$_GET["route"]:"appfile_page_index";
		$this->route = $route;
		$this->loadRouting(); // routing kernel
		$this->loadService(); // service kernel

		$dataRoute = $this->routing[$route];

		$this->app = $dataRoute[0];

		if($dataRoute[2]=="page")
			$this->page = $dataRoute[1];
		else
			$this->exec = $dataRoute[1];

		$this->loadConfig(); // fichier config de l'app;
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
  	include(DIR_APP."/".$app."/form/".$form.".php");

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
  			// echo $this->app;

    include(DIR_APP."/".$this->app."/pages/".$this->page.".php");
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
		$q = ($send!="")?"&amp;".http_build_query($send, '', '&amp;'):"";
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

	function service($service){
		$serviceInfo = $this->services[$service."Service"];

		$app 		= $serviceInfo[0];
		$controller	= $serviceInfo[1];
		$method		= $serviceInfo[2];

		$dirService = DIR_APP."/".$app."/".$controller.".php";
		require_once($dirService);

		$service 	= new $controller();
		return $service->$method();
	}

	function loadConfig(){
		$configAppDIR = DIR_APP."/".$this->app."/config/config.json";
		$this->config =  json_decode(file_get_contents($configAppDIR), true);
	}

	function loadService(){
		$serviceAppDIR = DIR_APP."/".$this->app."/config/services.json";
		$this->services =  json_decode(file_get_contents(DIR_SERVICES), true);
	}

	function loadRouting(){
		$this->routing =  json_decode(file_get_contents(DIR_ROUTING), true);
	}


	function attr($attr){
		$r = "";
		foreach ($attr as $key => $value)
			$r .= $key.'="'.$value.'" ';
		return $r;
	}
}
class_alias('controller', 'app');
?>