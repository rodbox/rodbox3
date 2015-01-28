<?php

$root 	= realpath('.');
$to 	= $root;
$zipRemove = true;
$scan 	= scandir($root);
rsort($scan);

foreach ($scan as $key => $value) {
	$infos = pathinfo($value);

	if ($infos["extension"]=="zip") {
			$file = $root."/".$value;
			extractFile($file,$to,$zipRemove);

			return false;
	}
}

function extractFile($file,$to,$zipRemove=false){

	$zip = new ZipArchive;
	$zip->open($file);
	$zip->extractTo($to);
	$zip->close();

	($zipRemove)?unlink($file):"";
}

$r = array(
            'infotype'=>"success",
            'msg'=>"ok"
        );

echo json_encode($r);
?>