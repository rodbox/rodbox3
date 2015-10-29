<?php 

/**
* User
* $form->add($name="",$type="text",$value="",$options="",$attr=[]);
* $form->req(["name req1"," name req2",... ]);
*/
class formSnippet extends form
{
	function __construct($route="snippet_exec_save",$attr=[]){
		parent::__construct($route,$attr);
		
		$this->setId("snippet-editor");
		$this->setRoute("snippet_exec_save");
		$this->setLabelShow(true);
		// $this->setAppMsg("snippet");
		// $this->setAppMsg("snippet");
		$this->setControl([
				"snippetName"=> ["req"=>true],
				"trigger"=> ["req"=>true],
				"content"=> ["req"=>true]
			]);




		$this->setAttr(["class"=>""]);

		$this->add("snippetName","","","",[
			"id"=>"", 
			"class"=>"form-control",
			"placeholder"=>"SnippetName",
			"autocomplete"=>"off"
			]);
		$this->add("trigger","","","",[
			"id"=>"", 
			"class"=>"form-control",
			"placeholder"=>"trigger",
			"autocomplete"=>"off",
			"data-"=>""

			]);
		$this->add("myTextarea","textarea","","",[
			"id"=>"myTextarea", 
			"class"=>"form-control border-preview caretposition",
			"data-follower"=>"#sub"
		]);
		$this->add("desc","","","",["class"=>"form-control","placeholder"=>"Description"]);
		
		$this->add("type","select","",[
        	""=>"all",
        	"source.php"=>"php",
			"source.html"=>"html",
			"source.js"=>"javascript",
			"source.css"=>"css",
			"source.md"=>"md",
			"source.twig"=>"twig"
      
        ],["class"=>"form-control selectpicker"]);




		$this->add("category","select","",$this->model("snippet","cat-list"),["id"=>"category","class"=>"form-control selectpicker"]);

		
		$this->add("submit","submit","envoyer","",["class"=>"block btn btn-xl w-100 bg-1"]);
	}
	
}

 ?>