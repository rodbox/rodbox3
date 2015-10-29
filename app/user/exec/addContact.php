<?php

$em = $c->getEM();
$c->getEntity("user","userEntity");
$user = $em->getRepository("userEntity")->find($_SESSION["user"]["id"]);

$contactList = $user->getUserContact();
$contactList[]=$_GET["id"];
$_SESSION["user"]["contact"][]=$_GET["id"];
$user->setUserContact($contactList);

$em->persist($user);
$em->flush();

$error = array();



/* On renvois le bouton */
$content = $c->routeExec("user_exec_removeContact",'<i class="fa fa-check-circle "></i>',["id"=>$_GET["id"]],["class"=>"applivebt"],true);

/**** MON EXEC ****/
// foreach ($_POST["A TRAITER"] as $key => $value) {
	
// 	$eval = "MA FONCTION DE TRAITEMENT";

// 	if(!$eval)
// 		$error[] = $url;
// }
/**** END MON EXEC ****/



// $user = new userEntity($name);

// $c->em->persist($user);
// $c->em->flush();




$valid = (count($error)==0)?true:false; //la condition

/* Return for json content */
if($valid){
$r = array(
            'infotype'=>"success",
            'msg'=>"ok",
            'content'=>$content,
            'app'=>array(),
            'data'=>''
        );
}
else {
$r = array(
            'infotype'=>"error",
            'msg'=>"No",
            'content'=>"",
            'app'=>array(),
            'data'=>''
        );
}

?>