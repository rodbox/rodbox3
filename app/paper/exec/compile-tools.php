<?php 

	$appAutoload->mod("template");
	$appAutoload->mod("file");

	$template = new template;

	$fileModelTool = DIR_ROOT."paper/templates/tool-template.js";
	$fileModelCore = DIR_ROOT."paper/templates/core-template.js";
	
	$fileDest 		= DIR_ROOT."paper/js/app.js";

	$dir 		= DIR_PAPERTOOL;
	$list 		= file::list_file($dir);

  
	$compile	= "";

	/** foreach toollist  **/
	foreach ($list as $keyTool => $value){
		$dirTool = $dir."/".$value."/tool.json";

		$json = $c->getJson($dirTool);

		$dataReplace = array(
			"TOOL"			=> $value,
			"ONFRAME"		=> $json["onFrame"],
			"ONRESIZE"		=> $json["onResize"],
			"ONMOUSEDOWN"	=> $json["onMouseDown"],
			"ONMOUSEDRAG"	=> $json["onMouseDrag"],
			"ONMOUSEMOVE"	=> $json["onMouseMove"],
			"ONMOUSEUP"		=> $json["onMouseUp"],
			"ONKEYDOWN"		=> $json["onKeyDown"],
			"ONKEYUP "		=> $json["onKeyUp"]
		);
		$compile.= $template->templateFileContent($dataReplace,$fileModelTool);
	}
	
	/** end foreach toollist  **/

	$dataReplaceCore = array(
		"TOOLLIST"		=> $compile
	);

	$content = $template->templateFileContent($dataReplaceCore,$fileModelCore);

    if(file_put_contents($fileDest,$content)){
		$r = array(
	        'infotype'=>"success",
	        'msg'=>"Compilation réussie",
	        'data'=>'',
	        'msgmeta'=>''
	    );
    }

    else{
		$r = array(
			'infotype'=>"error",
			'msg'=>"Problèmes",
			'data'=>'',
			'msgmeta'=>''
		);

    }

?>