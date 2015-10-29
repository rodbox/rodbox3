<?php
	$appAutoload->mod("template");
	extract($_POST);
	
	$error = array();

	$tm = new template;
	$em = $c->getEM();
	$c->getEntity("user","userEntity");

	$eval = $c->service("userExist",["user"=>$User]);

	$validate = $c->form("user","formUser")->validate($_POST);


	if(!$eval && $validate){
		$user = new userEntity;

		$user->setUser($User);
		$user->setUserDateCrea(new \DateTime("now"));
		$user->setUserDateLastConnect(new \DateTime("now"));
		$user->setUserDateUpd(new \DateTime("now"));

		$user->setUserPassword($UserPassword);
		// $user->setUserPassword_confirm($UserPassword_confirm);

		$user->setUserLang($UserLang);

		$user->setUserCiv($UserCiv);
		$user->setUserLastname($UserLastname);
		$user->setUserFirstname($UserFirstname);
		$user->setUserMail($UserMail);
		$user->setUserRole("USER");

		$em->persist($user);
		$em->flush();

		$evalTM = $tm->templateFolder("user",DIR_USERS,$user->getId());

		$c->setFlash("Bienvenue <strong>".$User."</strong>. Votre inscription a bien été pris en compte.","success");
		
		$eval = $c->service("userLogin",["user"=>$User,"pw"=>$UserPassword]);

		$r = array(
            'infotype'=>"success",
            'msg'=>"ok",
            'data'=>'',
            'route'=>'user_page_edit',
            'validate'=>$validate
        );
	}

	else{
		$r = array(
            'infotype'=>"error",
            'msg'=>"Le nom d'utilisateur existe déja !",
            'data'=>"",
            'route'=>'user_page_index',
            'validate'=>$validate
        );
	}

?>