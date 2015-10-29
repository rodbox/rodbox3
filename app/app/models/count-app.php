<?php 
$appAutoload = new appAutoload;
$appAutoload->mod("file");

$dir 	= DIR_APP;


$d["countApp"]= count(file::folder_list($dir,false));
$d["countRoute"]= count($c->routing);
$d["countService"]= count($c->services);
$d["countSnippet"]= count(file::file_list(DIR_SNIPPETS,false));
$d["countProject"]= count(file::folder_list(DIR_PROJECTS,false));
$d["countUser"]= count(file::folder_list(DIR_USERS,false))-1;

 ?>