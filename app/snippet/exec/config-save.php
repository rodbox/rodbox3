<?php 

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

	$cssSnippet = '.snippets-list li:before{
	font-family: "Glyphicons Halflings";
	content:"\e165";
	font-size: 0.5em;
	float: right;
	line-height: 4.2em;
	margin-right: 10px;
}'."\n";

	foreach ($_GET['title'] as $key => $value) {
		$jsonArray["category"][$value] = array(
			"title"		=> $_GET["title"][$key],
			"color"		=> $_GET["color"][$key],
			"prefix"	=> $_GET["prefix"][$key]
		);

		$prefixList = explode("|",$_GET["prefix"][$key]);
		foreach ($prefixList as $prefixKey => $prefixValue) {
			$cssSnippet .= '/*** '.$_GET["title"][$key].' ***/'."\n"; 
			$cssSnippet .= '.snippets-list li[id^="'.$prefixValue.'-"]:before{color: '.$_GET["color"][$key].';}'."\n"; 
			$cssSnippet .= '.snippets-list li[id^="'.$prefixValue.'-"].onChecked{background-color: rgba('.hexToRgb($_GET["color"][$key]).',0.2) !important;}'."\n"; 
			$cssSnippet .= '.snippets-list li[id^="'.$prefixValue.'-"].onFocus.onChecked{background-color: rgba('.hexToRgb($_GET["color"][$key]).',0.1) !important;}'."\n"; 
			$cssSnippet .= '.snippets-list li[id^="'.$prefixValue.'-"].onFocus.onOpen{background-color: rgba('.hexToRgb($_GET["color"][$key]).',0.7) !important;}'."\n"; 
			$cssSnippet .= '.snippets-list li[id^="'.$prefixValue.'-"].onOpen{background-color: '.$_GET["color"][$key].' !important;}'."\n"; 

			$cssSnippet .= '.c-cat-color-'.$_GET["title"][$key].'{color: '.$_GET["color"][$key].';}'."\n"; 
			$cssSnippet .= '.bg-cat-color-'.$_GET["title"][$key].'{background-color: '.$_GET["color"][$key].';}'."\n\n"; 
		}

	}
	$json = json_encode($jsonArray);
	file_put_contents("../config.json", $json);
	file_put_contents("../snippet-color.css", $cssSnippet);

	$r = array(
	            'infotype'=>"success",
	            'msg'=>"ok",
	            'data'=>''
	        );
	
	echo json_encode($r);
?>