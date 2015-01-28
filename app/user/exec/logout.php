<?php 

unset($_SESSION["user"]);

$r = array(
            'infotype'=>"success",
            'msg'=>"ok",
            'data'=>['route'=>"user_page_login"]
        );
$c->headerRoute("user_page_login");
?>