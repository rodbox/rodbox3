<?php 
	$rand = substr( md5(rand()), 0, 8);

	$dirTarget 	= realpath("../tmp")."/".$rand."/";
	mkdir($dirTarget);

	$dirSnippet = realpath("../snippets")."/";

	$snippetList = $_GET["snippet-file"];

	$zipFile = "snippet-list.zip";
	$dirZip = $dirTarget.$zipFile;

 	$z = new ZipArchive();
    $z->open($dirZip, ZIPARCHIVE::CREATE);

	foreach ($snippetList as $key => $value) {
		$file = $value.".sublime-snippet";
		$dirFile = $dirSnippet.$file;
		$z->addFile($dirFile,$file);
	}
	    

    
    $z->close();

    $r = array(
                'infotype'=>"success",
                'msg'=>"ok",
                'data'=>['url'=>'tmp/'.$rand.'/'.$zipFile]
            );
    
    echo json_encode($r);
 ?>