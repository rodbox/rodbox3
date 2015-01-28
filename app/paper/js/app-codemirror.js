$(document).ready(function(){

var textareaList = $(".tool-event");

var paramCm = [];

$.each(textareaList, function(index, val) {
	var textarea = $(val);
	var id = textarea.attr("id");
	var editorID = 'editor'+id;
	
	 /* CODE MIRROR  */
	  paramCm[id] = CodeMirror.fromTextArea(eval(id), {
	      theme         : "twilight",
	      lineNumbers        : true,
	      tabSize        : 8,
	      lineWrapping    : true,
	      mode        : "javascript",
	      keyMap        : "sublime",
	      matchBrackets    : true
	  });
	  /* Mise a jour du textarea d'origine */
	  paramCm[id].on("change",function(editor, change){
	      paramCm[id].save();
	  });
});



	$("a#open-tool").appLiveExec({
	 	form : ".save-tool",
	 	callback:function (json,t){
	 		paramCm["onInit"].setValue(json.data.onInit);
	 		paramCm["onFrame"].setValue(json.data.onFrame);
	 		paramCm["onResize"].setValue(json.data.onResize);
	 		paramCm["onMouseDrag"].setValue(json.data.onMouseDrag);
	 		paramCm["onMouseDown"].setValue(json.data.onMouseDown);
	 		paramCm["onMouseMove"].setValue(json.data.onMouseMove);
	 		paramCm["onMouseUp"].setValue(json.data.onMouseMove);
	 		paramCm["onKeyDown"].setValue(json.data.onKeyDown);
	 		paramCm["onKeyUp"].setValue(json.data.onKeyUp);
	 	}
	 });

	$("a.applive").appLiveExec({
	 	form : ".save-tool"
	 });

	$("a.save-as").appLiveExec({
	 	form : ".save-tool",
	 	callback:function(){
	 		var toolList = $("#tool");
	 		var toolName = $("#toolName").val();
	 		var newOptions = $("<option>",{"value":toolName}).html(toolName);
	 		$("#toolName").val("");
	 		toolList.append(newOptions);
	 		toolList.val(toolName);
	 	}
	 });



	$('a#new-tool').on("click",function(){
		cleanEdit();
		return false;
	})

	$(document).on("change","#tool",function (e){
		$('#open-tool').trigger("click");
		
		
	})

	function cleanEdit(){
		$('#toolName').val("");
		$('#toolFileMenu').val("");
		paramCm["onInit"].setValue("");
		paramCm["onFrame"].setValue("");
		paramCm["onResize"].setValue("");
		paramCm["onMouseDrag"].setValue("");
		paramCm["onMouseDown"].setValue("");
		paramCm["onMouseMove"].setValue("");
		paramCm["onMouseUp"].setValue("");
		paramCm["onKeyDown"].setValue("");
		paramCm["onKeyUp"].setValue("");
	}
});



