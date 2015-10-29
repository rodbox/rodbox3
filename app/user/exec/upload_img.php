<?php
$error = array();

$destination    = DIR_MY;

$i = 0;
$error = 0;
foreach ($_FILES as $key => $value) {
	$source = $_FILES[$key]['tmp_name'];
	$destRef = $destination . "/log-ref.jpg";
	$destLog = $destination . "/log.jpg";


	$rand	= substr( md5(rand()), 0, 8);
	$url = WEB_MY."/log-ref.jpg?rand=".$rand;
	$moveLog = move_uploaded_file($source, $destLog);
	$moveRef = copy($destLog, $destRef);
	if($moveLog&&$moveRef){
		$i++;
	}
	else{
		$error++;
	}
}

$r = array(
	'infotype'=>"Fichier uploader",
	'msg'=>"ok",
	'data'=>$url
);


?>