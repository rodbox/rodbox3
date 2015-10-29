<?php

$paletteList = $json["palettes-list"];

$paletteDir = DIR_PALETTES.'/'.$paletteList.'/'.$paletteList.'.json';
$palette = $c->getJson($paletteDir);
$suf = $palette["suf"];
$palette = $palette["palette"];

function hexToRgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return implode(",", $rgb); // returns the rgb values separated by commas
   // return $rgb; // returns an array with the rgb values
}


$css = "";

foreach ($palette["key"] as $key => $color) {

	$colorValue 	= $color;

	$colorRef	 	= $key+1;
	$colorName 		= $palette["name"][$key];

	$css .= ".c-".$colorName.$suf .", \n";
	$css .= ".c-".$colorRef.$suf ." {";
	$css .= "\tcolor : ";
	$css .= "rgb(".hexToRgb($colorValue).") !important;";
	$css .= "}\n\n";	

	$css .= ".bg-".$colorName.$suf .",\n";

	$css .= ".bg-".$colorRef.$suf ." {";
	$css .= "background-color : ";
	$css .= "rgb(".hexToRgb($colorValue).") !important;";
	$css .= "}\n\n";

	$css .= ".border-".$colorRef.$suf .",\n";
	$css .= ".border-".$colorName.$suf ." { ";
	$css .= "border-color : rgb(".hexToRgb($colorValue).") !important;";
	$css .= "}\n\n";

}
// $css .="</style>\n";
?>