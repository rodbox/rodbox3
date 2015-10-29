<?php 
	extract($_POST);
		$response = true;
	$em = $c->getEM();
	$c->getEntity("user","userEntity");
	$eval = $c->service("userLogin",["user"=>$User,"pw"=>$UserPassword]);

	if($eval["eval"]){

		$hour = date("H"); 
		$msgByHour = ($hour >= 5 && $hour <= 17)?"Bonjour":"Bonsoir";

		$msg 			= $msgByHour.' <strong>'.$_POST["User"].'</strong>';




		$c->setFlash($msg,"info");


		$r = array(
		            'infotype'=>"success",
		            'msg'=>"ok",
		            'data'=>['msg'=>$msg,'route'=>'app_page_index'],
		            'app'=>$eval["eval"],
		            'eval'=>true,
		            'response'=>$response
		        );
	}
	else{
			$r = array(
	            'infotype'=>"error",
	            'msg'=>"ok",
	            'data'=>['route'=>'user_page_login'],
	            'eval'=>false,
	            'response'=>true
	        );
	}

?>