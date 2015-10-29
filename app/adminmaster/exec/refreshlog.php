<?php
$error = array();

$log = file_get_contents(DIR_LOG);


$r = array(
            'infotype'=>"success",
            'msg'=>"ok",
            'data'=>'',
            'app'=>$log
        );

?>