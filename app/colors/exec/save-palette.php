<?php  

$error = array();

$json['title'] 	=  $_POST["title"];
$json['name'] 	=  "Rodbox.fr";
$json['suf'] 	=  $_POST["suf"];
$json['date'] 	=  date("d-m-y H:i");
$png 			=  $_POST["png"];

$dir 	= DIR_PALETTES."/palette-".$_POST["title"]."/";

if(!file_exists($dir))
	mkdir($dir);

foreach ($_POST["color-value"] as $key => $value) {
	$name  = $_POST["color-name"][$key];
	$json["palette"]["name"] = $_POST["color-name"];
	$json["palette"]["key"][] = $value;
	# code...
}
$jsonFile = json_encode($json,JSON_PRETTY_PRINT);

$fileName = "palette-".$_POST["title"].".json";
$pngName = "palette-".$_POST["title"].".png";



/* IMAGE */
$unencodedData=base64_decode($png);
$png = str_replace('data:image/png;base64,', '', $png);
$png = str_replace(' ', '+', $png);
$dataImg = base64_decode($png);
file_put_contents($dir.$pngName, $dataImg);
/* END IMAGE */





if(!file_put_contents($dir.$fileName, $jsonFile))
	$error[] = "probleme d'enregistrement du fichier !";

$url = WEB_PALETTES.'/palette-'.$_POST["title"]."/".$fileName;
$data = '<a href="'.$url.'" download="'.$fileName.'" class="big-5 block text-center c-7">'.$fileName.'</a>';

$r = array(
            'infotype'=>"success",
            'msg'=>"ok",
            'data'=>$data
        );

// ?>

