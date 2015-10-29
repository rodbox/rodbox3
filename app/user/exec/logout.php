<?php 
$name = $_SESSION["user"]["username"];
unset($_SESSION["user"]);

$msg = 'A bientôt <strong>'.$name.'</strong>';

$c->setFlash($msg,"info");
$r = array(
    'infotype'=>"success",
    'msg'=>"",
    'data'=>['msg'=>$msg,'route'=>"user_page_login"]
);

?>