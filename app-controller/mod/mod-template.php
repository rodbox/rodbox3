<?php 

class template extends controller{
	
	function __construct()
	{
		# code...
	}

	static function templateFileContent($data, $fileModel) {
        foreach ($data as $key => $val) {
            $find[] = "[" . $key . "]";
            $replace[] = $val;
        }
        $contentModel = file_get_contents($fileModel);
        $content = str_replace($find, $replace, $contentModel);

        return $content;
    }

    function keyValContent($data, $contentModel) {
        foreach ($data as $key => $val) {
            $find[] = "[" . $key . "]";
            $replace[] = $val;
        }
        $content = str_replace($find, $replace, $contentModel);

        return $content;
    }

/* recupere le contenue de fileModel replace les $data[KEY] par $data[KEY]value 
et enregistre le fichier dans foleTarget.
*/
    function keyValFileContent($data, $fileModel,$fileTarget="") {
        $fileTarget = ($fileTarget=="")?$fileModel:$fileTarget;

        foreach ($data as $key => $val) {
            $find[] = "[" . $key . "]";
            $replace[] = $val;
        }
        $contentModel = file_get_contents($fileModel);
        $content = str_replace($find, $replace, $contentModel);

        return file_put_contents($fileTarget, $content);
    }
/** 
 *  
 * copi un fichier du dossier template vers target dir 
 * le fichier est renommé si newFileName !=""
 *
 **/

    function templateFile($templateFile, $targetDir, $newFileName = "") {
        $src = DIR_TEMPLATES . "/files/" . $templateFile;
        $info = pathinfo($templateFile);

        if ($newFileName == "") {
            $newFileName = $info["filename"];
        }

        $dest = $targetDir . "/" . $newFileName . "." . $info["extension"];

        if (!file_exists($dest)) {
            if(copy($src, $dest))
                return ["eval"=>true,"newfile"=>$newFileName . "." . $info["extension"]];
        }
      else return false;
    }

/* Creer un dossier a partir d'un template
il peux renommer les fichiers pointer dans le array $rename
il peux remplacer des element dans un fichiers pointer dans le array $replace
 */
/**
 * [templateFolder description]
 * @param  string  $templateFolder      _TEMPLATES_/folder/$templateFolder
 * @param  string  $targetDir           target template
 * @param  string  $newFolderName       new folder name
 * @param  array $replace               array [KEY] replace by value ["KEY"=>"my content replace KEY"]
 * @param  boolean $rename              array [key template dir file] value = new name
 * @param  boolean $forceReplaceCopy    bool force replace if folder exist

 */
    function templateFolder($templateFolder, $targetDir, $newFolderName,$replace=false,$rename=false,$forceReplaceCopy = false) {
        $src = DIR_TEMPLATES."/folder/".$templateFolder;
        $dest = $targetDir . "/" . $newFolderName;

       // echo DIR_TEMPLATE . "/" . $name;
        // on copi le template
        if (!file_exists($dest) || $forceReplaceCopy==true) {
            $eval = self::copy_dir_replace_rename($src, $dest,$replace,$rename);
            if($eval)
                return $this->success("template créé");
            else
                return $this->error("un problème de copie");
        }
        else
            return $this->error("dossier existant");
    }

/* Fait une copie d'un dossier avec toute son arborescence de fichiers et de dossier */
/**
 * *
 * @param  [string] $dir2copy  [dir rource]
 * @param  [string] $dir_paste [dir dest]
 * @return [bool]            [description]
 */
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

    function copy_dir_replace_rename($dir2copy, $dir_paste,$replace,$rename) {

        // On vérifie si $dir2copy est un dossier
        if (is_dir($dir2copy)) {

            // Si oui, on l'ouvre
            if ($dh = opendir($dir2copy)) {

                // On liste les dossiers et fichiers de $dir2copy
                while (($file = readdir($dh)) !== false) {
                    $fileModel = $dir2copy . '/' . $file;
                    $fileTarget = $dir_paste . '/' . $file;



                    // Si le dossier dans lequel on veut coller n'existe pas, on le créé
                    if (!is_dir($dir_paste))
                        mkdir($dir_paste, 0777);

                    // S'il s'agit d'un dossier, on relance la fonction récursive
                    if (is_dir($fileModel) && $file != '..' && $file != '.'){

                        self::copy_dir_replace_rename($fileModel . '/', $fileTarget . '/',$replace,$rename);
                    }
                    // S'il sagit d'un fichier, on le copue simplement
                    elseif ($file != '..' && $file != '.'){
                        if (array_key_exists($fileTarget, $rename))
                            $fileTarget = $rename[$fileTarget];

                        self::keyValFileContent($replace, $fileModel,$fileTarget);
                    }
                }

                // On ferme $dir2copy
                closedir($dh);
                return true;
            }
        }
    }

}

 ?>