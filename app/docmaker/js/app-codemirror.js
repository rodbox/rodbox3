$(document).ready(function(){

/**** CODE MIRROR  ****/
	var editor = CodeMirror.fromTextArea(myTextarea, {
	    theme 			: "twilight",
	    lineNumbers		: true,
	    tabSize			: 8,
	    lineWrapping	: true,
	    'mode'			: "php",
	    keyMap			: "sublime",
	    matchBrackets	: true,
	    autoCloseBrackets: true
	});

/*** EVENT EDITOR ***/
	/* Mise a jour du textarea d'origine */
	editor.on("change",function(editor, change){
	    editor.save();
	});
	editor.on("contextmenu",function(editor,e){
	    toggleMouseMenu(e.clientX,e.clientY);
		$(document)[0].oncontextmenu = function() {
			return false;
        }
	    return false;
	});
/*** END EVENT EDITOR ***/
/**** END CODE MIRROR  ****/

	/*** Editor ***/
	/* new */
	$(document).on("click","#new-model",function (e){
		var t = $(this);
		if (editor.isClean()) {
			editor.setValue("");
			editor.markClean();
			$('#doc-list').val("");
			$('#new-file').val("");
			$('#iframe-preview').attr("src","");
		}
		else{
			if(confirm("enregistrer les modifs")){
				editor.setValue("");
				editor.markClean();
				t.attr("data-open",$('#doc-list').val(""));
				$('#doc-list').val("");
				$('#iframe-preview').attr("src","");
			}
		}
		return false;
	})
	

	/* Save */
	$('#save-model').appLiveExec({
		form:"#manage-models",
		callback:function(json,t){
			if (json.data.new) {
				var option = $("<option>",{"value":"models"}).html(json.data.models);
				$('#doc-list').append(option)
				$('#doc-list').val(json.data.models);
			};
			editor.markClean();
			$('#pdf-model').trigger('click');
		}
	});

	/* Open */
	$('#open-model').appLiveExec({
		form:"#manage-models",
		callback:function(json,t){
			if (editor.isClean()) {
				loadMeta(json.data);
				t.attr("data-open",json.data.models);

				previewPdf(json.data.models);
				

				/* Code editor */
				editor.setValue(json.data.myTextarea);
				editor.markClean();
				/* Editor css*/
				editorCss.markClean();				
				editorCss.setValue(json.data.stylesCss);

				editorHeader.markClean();				
				editorHeader.setValue(json.data.docHeader);

				editorFooter.markClean();				
				editorFooter.setValue(json.data.docFooter);
				// $('#pdf-model').trigger('click');
			}
			else{
				if(confirm("enregistrer les modifs")){
					editor.setValue(json.data);
					editor.markClean();
					t.attr("data-open",$('#doc-list').val());
					
					$('#pdf-model').trigger('click');
				}
				else{
					$('#doc-list').val(t.attr("data-open"));
					$('#new-file').val($('#doc-list').val());
				}
			}
		}
	});

	/* Preview */
	$(document).on("click","#pdf-model",function (e){
		var t = $(this);
		var model = $('#doc-list').val();
		previewPdf(model)


		return false;
	})


	function previewPdf(model){
		var src = $.routeExec("docmaker_exec_pdf-doc",{"doc-list":model});
		console.log(src);
		$('#iframe-preview').attr("src",src);
	}


	$(document).on("change",'#doc-list',function (e){

		$('#open-model').trigger('click');
	})

	/* LOADDATA */
	/* Fonction qui attribut les valeurs a chaque champs du formulaire du fichier */
	function loadMeta(json){
		var form = $("form").find('input, select, textarea');
		form.each(function(){
			if($(this).attr('type') != 'submit') {
	        	var input = $(this);
	            var value = json[input.attr('name')];
	            if(input.attr('type') == 'radio' || input.attr('type') == 'checkbox') {
	            	eval = (value == input.val())
                	input.prop('checked', eval);
	            } 
	            else {
	           		input.val(value);
				}
	        }
    	})
	}
	/* END LOADDATA */


	/* End Editor */

	/* Permet de fermer le menu */
	$(document).on("click","#docmaker-editor li.active",function (e){
		var t = $(this);
		t.removeClass("active");
		var tabID = t.find("a").attr("href");
		$(tabID).removeClass("active");
	})

	$(document).on("change","#cm-mode",function (e){
		var t = $(this);
		editor.setOption("mode",t.val());
	});


/*** CODE MIRROR CSS ***/
	var editorCss = CodeMirror.fromTextArea(stylesCss, {
	    theme 			: "twilight",
	    lineNumbers		: true,
	    tabSize			: 8,
	    lineWrapping	: true,
	    'mode'			: "css",
	    keyMap			: "sublime",
	    matchBrackets	: true,
	    autoCloseBrackets: true
	});


	/* Mise a jour du textarea d'origine */
	editorCss.on("change",function(editorCss, change){
	    editorCss.save();
	});
/*** END CODE MIRROR CSS ***/


/*** CODE MIRROR Header ***/
	var editorHeader = CodeMirror.fromTextArea(docHeader, {
	    theme 			: "twilight",
	    lineNumbers		: true,
	    tabSize			: 8,
	    lineWrapping	: true,
	    'mode'			: "php",
	    keyMap			: "sublime",
	    matchBrackets	: true,
	    autoCloseBrackets: true
	});
	editorHeader.on("change",function(editorHeader, change){
	    editorHeader.save();
	});

/*** CODE MIRROR Footer ***/
	var editorFooter = CodeMirror.fromTextArea(docFooter, {
	    theme 			: "twilight",
	    lineNumbers		: true,
	    tabSize			: 8,
	    lineWrapping	: true,
	    'mode'			: "php",
	    keyMap			: "sublime",
	    matchBrackets	: true,
	    autoCloseBrackets: true
	});


	/* Mise a jour du textarea d'origine */
	editorFooter.on("change",function(docFooter, change){
	    docFooter.save();
	});

	/*LES INCLUDES AVEC $.getScript(); */
	window.editor = editor;
	$.getScript("../app/docmaker/js/app-codemirror-circlemenu.js",function(editor){

	});


});