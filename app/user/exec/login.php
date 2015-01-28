<?php 

$_SESSION["user"]["username"] = $_POST["User"];

$r = array(
            'infotype'=>"success",
            'msg'=>"ok",
            'data'=>['msg'=>'Bonjour <strong>'.$_POST["User"].'</strong>','route'=>'appfile_page_index']
        );
?>