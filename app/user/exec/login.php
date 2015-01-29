<?php 

$_SESSION["user"]["username"] = $_POST["User"];
$msg = $_SESSION["fullmsg"] = 'Bonjour <strong>'.$_POST["User"].'</strong>';
$r = array(
            'infotype'=>"success",
            'msg'=>"ok",
            'data'=>['msg'=>$msg,'route'=>'appfile_page_index']
        );
?>