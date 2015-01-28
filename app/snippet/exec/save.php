<?php 
function replace_Key_Val_File($data, $fileModel, $fileDest = "") {
        foreach ($data as $key => $val) {
            $find[] = "[" . $key . "]";
            $replace[] = $val;
        }
        $contentModel   = file_get_contents($fileModel,true);
        $content        = str_replace($find, $replace, $contentModel);
        if($fileDest != "")
            file_put_contents($fileDest, $content);
        else
            return $content;
    }

extract($_POST);
extract($_GET);

$file = $snippetName.".sublime-snippet";
$url = "snippets/".$file;

$replace = array(
	"TRIGGER" 	=> isset($trigger)?$trigger:"",
	"CONTENT"	=> isset($content)?$content:"",
	"DESC"		=> isset($desc)?$desc:"",
    "TYPE"      => isset($type)?$type:"",
	"CATEGORY"	=> isset($category)?$category:"",
	);



$dirSave =  realpath("..")."/".$url;
$dirTemplate =  realpath("..")."/templates/snippet.sublime-snippet";

replace_Key_Val_File($replace,$dirTemplate, $dirSave);

$r = array(
            'infotype'=>"success",
            'msg'=>"ok",
            'data'=>['name'=>$snippetName,'url'=>$url,'file'=>$file]
        );

echo json_encode($r);
?>

