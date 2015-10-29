<?php
$error = array();

$em = $c->getEM();
$c->getEntity("user","userEntity");
$user = $em->getRepository("userEntity")->find($_SESSION["user"]["id"]);

$contactList = $user->getUserContact();
/* LOG remove */
$c->log("remove",__FILE__,$contactList);
/* END LOG remove */
$key = array_search($_GET["id"],$contactList);
unset($contactList[$key]);
unset($_SESSION["user"]["contact"][$key]);
$user->setUserContact(array_values($contactList));

$em->persist($user);
$em->flush();



/* On renvois le bouton */
$content = $c->routeExec("user_exec_addContact",'<i class="icomoon-plus2 "></i>',["id"=>$_GET["id"]],["class"=>"applivebt"],true);




$valid = (count($error)==0)?true:false; //la condition

$r = array(
            'infotype'=>"success",
            'msg'=>"ok",
            'content'=>$content,
            'app'=>array(),
            'data'=>''
        );

?>