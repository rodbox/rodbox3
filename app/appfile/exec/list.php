<?php 
$dir = DIR_ROOT;
// $dir = realpath("../");
    function file_list($dir) {
        $filter     = array(".", "..","__MACOSX", "nbproject", "_notes", ".DS_Store", ".komodotools", "_tmp",".git",".gitignore",".meta"); //list des nom de fichier ou de dossier a ne pas indexer
        $list       = scandir($dir); // on scan le dossier
        $r          = array_diff($list, $filter); // on filtre le resultat
        $files      = [];
        foreach ($r as $key => $val) { //on parcour chaque element
            if (is_dir($dir . "/" . $val)) {
                unset($r[$key]); // on supprime le nom du dossier dans la liste de resultat car elle utilisé en clé pour les sous dossiers
                $r[$val] = file_list($dir . "/" . $val);
            }else{
                unset($r[$key]);
                // $files[] = $val;
                $r["zzz".$val] = $val;
            }
        }
        ksort($r);
        return $r;
    }

$list = file_list($dir);




$r = array(
            'infotype'=>"success",
            'msg'=>"ok",
            'data'=>['filelist'=>$list,'webroot'=>WEB_ROOT]
        );

?>