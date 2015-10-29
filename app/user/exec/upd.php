<?php 

	extract($_POST);

	$em = $c->getEM();
	$c->getEntity("user","userEntity");
	$form  =  $c->form("user","formUserEdit")->validate();

	/* LOG validate */
	$c->log("validate",__FILE__,$form);
	/* END LOG validate */

	$user = $em->getRepository("userEntity")->find($id);


	$user->setUserLastname($_POST["UserLastname"]);
	$user->setUserFirstname($_POST["UserFirstname"]);
	$user->setUserCiv($_POST["UserCiv"]);
	$user->setUserLang($_POST["UserLang"]);
	$user->setUserMail($_POST["UserMail"]);
	$user->setUserTel($_POST["UserTel"]);
	$user->setUserSkype($_POST["UserSkype"]);
	$user->setUserFacebook($_POST["UserFacebook"]);
	$user->setUserPinterest($_POST["UserPinterest"]);
	$user->setUserDateUpd(new \DateTime("now"));

	$em->persist($user);
	$em->flush();

	$r = array(
        'infotype'=>"success",
        'msg'=>"ok",
        'data'=>''
    );
?>