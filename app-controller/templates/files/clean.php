<?php 
$dir = dirname(__FILE__);
$extractor = $dir."/".$_GET["demo"]."/zip_extract.php";
 unlink($extractor); 
?>