<?php 
$appAutoload->mod("template");

extract($_POST);
extract($_GET);

$template = new template;

$templateFile = "snippet.sublime-snippet";
$filename = $snippetName;


$replace = array(
	"TRIGGER" 	=> isset($trigger)?$trigger:"",
	"CONTENT"	=> isset($myTextarea)?$myTextarea:"",
	"DESC"		=> isset($desc)?$desc:"",
    "TYPE"      => isset($type)?$type:"",
	"CATEGORY"	=> isset($category)?$category:"",
	);


$template->templateFile($templateFile,DIR_SNIPPETS, $filename,$replace,true);

$r = array(
            'infotype'=>"success",
            'msg'=>"Snippet enregistré",
            'data'=>['name'=>$snippetName,'url'=>WEB_SNIPPETS."/".$filename,'file'=>$filename]
        );

?>

