<?php 
$appAutoload->mod("file");


$item 		= "perso-1";
$anim 		= "intro";
$byLine 	= 5;

$folderScan 	= "anim/".$item."/".$anim."/";

$web 		= WEB_RESSOURCES."/".$folderScan;
$dirRessource 		= DIR_RESSOURCES."/".$folderScan;
$list   	= file::file_list($dirRessource);
?>

<h1><?php echo $folderScan; ?></h1>
<?php echo $list; ?>