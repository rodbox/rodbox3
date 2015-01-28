<?php
include("../../include.php");

$dir = "../tmp/";

foreach ($_POST["frame"] as $key => $png) {
	$frameNum = str_pad($key, 2, "0", STR_PAD_LEFT);
	$pngName = "frame_".$frameNum.".png";

	/* IMAGE */
	$unencodedData=base64_decode($png);
	$png = str_replace('data:image/png;base64,', '', $png);
	$png = str_replace(' ', '+', $png);
	$dataImg = base64_decode($png);
	file_put_contents($dir.$pngName, $dataImg);
	/* END IMAGE */
}

$r = array(
            'infotype'=>"success",
            'msg'=>"ok",
            'data'=>["url"=>WEB_SPRITES_EXPORT]
        );

echo json_encode($r);


?>