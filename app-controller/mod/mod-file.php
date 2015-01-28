<?php

class file extends controller {

    function tmp_dir(){
        $rand  = app::random_string(32);
        $dir_tmp = DIR_TMP."/".$rand;
        mkdir($dir_tmp);

        return $rand;
    }

    function copy_dir($dir2copy, $dir_paste) {

        // On vérifie si $dir2copy est un dossier
        if (is_dir($dir2copy)) {

            // Si oui, on l'ouvre
            if ($dh = opendir($dir2copy)) {

                // On liste les dossiers et fichiers de $dir2copy
                while (($file = readdir($dh)) !== false) {

                    // Si le dossier dans lequel on veut coller n'existe pas, on le créé
                    if (!is_dir($dir_paste))
                        mkdir($dir_paste, 0777);

                    // S'il s'agit d'un dossier, on relance la fonction récursive
                    if (is_dir($dir2copy . '/' . $file) && $file != '..' && $file != '.')
                        self::copy_dir($dir2copy . '/' . $file . '/', $dir_paste . '/' . $file . '/');
                    // S'il sagit d'un fichier, on le copue simplement
                    elseif ($file != '..' && $file != '.')
                        copy($dir2copy . '/' . $file, $dir_paste . '/' . $file);
                }

                // On ferme $dir2copy
                closedir($dh);
                return true;
            }
        }
    }


    /*
      Retourne la liste des fichiers et dossier d'un dossier
     */

    function listDir($dir,$rel=true) {
        if (is_dir($dir)) {
            $filter = array(".", "..","__MACOSX", "nbproject", "_notes", ".DS_Store", ".komodotools", "_tmp"); //list des nom de fichier ou de dossier a ne pas indexer
            $list = scandir($dir); // on scan le dossier
            $r = array_diff($list, $filter); // on filtre le resultat
            foreach ($r as $val) {
                if($rel)
                    $src = $dir . "/" . $val;
                else
                    $src = $val;
                $d[] = $src;
            }
            return $d;
        }
        else
            return array();
    }

    static function folder_list($dir,$rel=true) {

        $filter     = array(".", "..","__MACOSX", "nbproject", "_notes", ".DS_Store", ".komodotools", "_tmp"); //list des nom de fichier ou de dossier a ne pas indexer
        $list       = scandir($dir); // on scan le dossier
        $r          = array_diff($list, $filter); // on filtre le resultat
        foreach ($r as $val) {
            $srcEval = $dir . "/" . $val;

            if (is_dir($srcEval)){
                if($rel)
                    $src = $srcEval;
                else
                    $src = $val;
                
                $d[] = $src;
            }
        }
        return $d;
    }

    static function file_list($dir,$suffix="") {
        $filter     = array(".", "..","__MACOSX", "nbproject", "_notes", ".DS_Store", ".komodotools", "_tmp"); //list des nom de fichier ou de dossier a ne pas indexer
        $list       = scandir($dir); // on scan le dossier
        $r          = array_diff($list, $filter); // on filtre le resultat

        foreach ($r as $key => $val) { //on parcour chaque element

            if (is_dir($dir . "/" . $val)) {
                unset($r[$key]); // on supprime le nom du dossier dans la liste de resultat car elle utilisé en clé pour les sous dossiers
                
            }
            else
                $r[$key] = basename($val,$suffix);
        }

        return $r;
    }

    static function file_list_mono($dir, $suffix = null) {
        $filter     = array(".", "..","__MACOSX", "nbproject", "_notes", ".DS_Store", ".komodotools", "_tmp"); //list des nom de fichier ou de dossier a ne pas indexer
        $suffix     = ($suffix != null) ? $suffix . "/" : null;

        $list       = scandir($dir); // on scan le dossier
        $r          = array_diff($list, $filter); // on filtre le resultat

        foreach ($r as $key => $val) { //on parcour chaque element
            if (is_dir($dir . "/" . $val)) {
                unset($r[$key]); // on supprime le nom du dossier dans la liste de resultat car elle utilisé en clé pour les sous dossiers
                // echo $dir."/".$val."\n";
                $rsub = self::file_list_mono($dir . "/" . $val, $suffix . $val);
                foreach ($rsub as $key2 => $val2) {
                    $r[] = $val2;
                }
            } else {
                $r[$key] = ($suffix != null) ? $suffix . $val : $val;
            }
            // $r = array_merge($r,$sub);
        }

        return $r;
    }


    function deleteAll($filepath) {
        if (is_dir($filepath) && !is_link($filepath)) {
            if ($dh = opendir($filepath)) {
                while (($sf = readdir($dh)) !== false) {
                    if ($sf == '.' || $sf == '..') {
                        continue;
                    }
                    if (!self::deleteAll($filepath . '/' . $sf)) {
                        throw new Exception("$filepath $sf  n'a pas pu être supprimé.");
                    }
                }
                closedir($dh);
            }
            return rmdir($filepath);
        }
        return unlink($filepath);
    }

    function format_taille($size) {
        if ($size == 0)
            return "0";
        $liste  = array(" octets", " Ko", " Mo", " Go", " To");
        $index  = floor(log($size) / log(1024));
        $frm    = (($size > 1023) ? ("%3.2f") : ("%d"));

        return sprintf("$frm%s", (($size) ? ($size / pow(1024, $index)) : "0"), $liste[$index]);
    }

    
    
    function dir_size($dir) {
        $filter = array(".", "..","__MACOSX", "nbproject", "_notes", ".DS_Store", ".komodotools", "_tmp"); //list des nom de fichier ou de dossier a ne pas indexer
        $list   = scandir($dir); // on scan le dossier
        $r      = array_diff($list, $filter); // on filtre le resultat

        foreach ($r as $key => $val) { //on parcour chaque element
            $cur = $dir . "/" . $val;
            if(is_dir($cur)){
                $dirSize  = self::dir_size($cur);
                $size = $size+$dirSize;
                
            }
            else
             $size = $size+filesize($cur);
           
        }
       // debug::dataVar($list);
        return $size;
    }
    
    function filename ($file){
        $infos = pathinfo($file);
        return $infos['filename'];
    }

    function ext ($file){
        $infos = pathinfo($file);
        return $infos['extension'];
    }

    function minifyCSS( $css ) {
        $css = preg_replace( '#\s+#', ' ', $css );
        $css = preg_replace( '#/\*.*?\*/#s', '', $css );
        $css = str_replace( '; ', ';', $css );
        $css = str_replace( ': ', ':', $css );
        $css = str_replace( ' {', '{', $css );
        $css = str_replace( '{ ', '{', $css );
        $css = str_replace( ', ', ',', $css );
        $css = str_replace( '} ', '}', $css );
        $css = str_replace( ';}', '}', $css );

        return trim( $css );
    }

    function minifyJS($js){
        // remove console.log
        $js = preg_replace('/console.log\([\w"]{0,}[)]{1}[;]{}/', '', $js);
        // remove comments multi line
        $js = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $js);
        // remove comments single line
        $js = preg_replace('!\/\/[^\n\r]*(?:[\n\r]+|$)!', '', $js);
        // remove tabs, spaces, newlines, etc.
        $js = str_replace(array("  ", "\r", "\n", "\t"), '', $js);
        return $js;
    }

    
}

?>
