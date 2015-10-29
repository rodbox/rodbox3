<?php
	$appAutoload->mod("template");

	$tm = new template;
extract($_POST);
if($file_type!="dir"){
	$doit =  $tm->templateFile($file_type,DIR_ROOT."/".$location,$file_create);
	$eval = $doit["eval"];
	$newfile = $doit["newfile"];

	$li = '<li class="search-show newfile" data-index="'.$location.'/'.$newfile.'" data-val="'.$newfile.'" data-dir="'.$location.'" data-type="file">
<a class="file-link" href="'.$location.'/'.$newfile.'" data-location="'.$location.'/'.$newfile.'">'.$newfile.'</a>
</li>';


}
else{
	$eval = mkdir(DIR_ROOT."/".$location."/".$file_create);
	$li = '<li class="search-show newfile" data-index="'.$location.'/'.$file_create.'" data-val="'.$file_create.'" data-dir="'.$location.'" data-type="folder">
<a class="folder-link" href="'.$location.'/'.$file_create.'" data-location="'.$location.'/'.$file_create.'">'.$file_create.'</a>
</li><ul  class="file-list" data-location="'.$location.'/'.$file_create.'"></ul>';
}
	
if($eval!=false){
$r = array(
            'infotype'=>"success",
            'msg'=>"ok",
            'data'=>$li
        );
}
else{
	$r = array(
            'infotype'=>"error",
            'msg'=>"Le fichier existe déja",
            'data'=>''
        );

}



?>