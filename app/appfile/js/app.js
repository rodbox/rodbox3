$(document).ready(function(){

	var mode = {
			js	: "javascript",
			php	: "php",
			html: "php",
			less: "text/x-less",
			css	: "css",
			scss: "css",
			md	: "markdown",
			"sublime-snippet"	: "xml",
			txt	: "markdown"
		}

$('.appfile').appfile();

/* CODE MIRROR  */
var editor = CodeMirror.fromTextArea(myTextarea, {
    theme         	: "twilight",
    lineNumbers     : true,
    tabSize        	: 4,
    lineWrapping    : true,
    mode        	: "php",
    keyMap        	: "sublime",
    extraKeys: {"Ctrl-Space": "autocomplete"},
    matchBrackets   : true
});
/* Mise a jour du textarea d'origine */
editor.on("change",function(editor, change){
    editor.save();
    bodyLockOn();
});
editor.on("contextmenu",function(editor,e){
	    toggleMouseMenu(e.clientX,e.clientY);
		$(document)[0].oncontextmenu = function() {
			return false;
        }

	    return false;
	});

function onOpen(t){
	$(".onOpen").removeClass("onOpen");
	t.addClass("onOpen");
}

/* FUNCTION BODY LOCK */
function bodyLockEval(){
	if($("body").data("lock")){
		if(confirm("Enregistrer les modifications ?")){
			$("a.cm-save").trigger("click");
			return true;
		}
		else{
			bodyLockOff();
			return true;
		}
	}
	else
		return true;
}
function bodyLockOn(){ 
	$("body")
	.data("lock",true)
	.addClass("onLock");
}
function bodyLockOff(){ 
	$("body")
	.data("lock",false)
	.removeClass("onLock");
}
/* END FUNCTION BODY LOCK */

$(document).on("click","a.file-link",function (e){
	e.preventDefault();	
	url = $.routeExec("appfile_exec_edit");
	var t = $(this);
	/* TEST SI IL Y A EU DES MODIFICATION */
	if(bodyLockEval()){

		var fileLocation = t.data("location");

		var data = {
			file:fileLocation
		};
		
		var ext = fileLocation.substring(fileLocation.lastIndexOf('.') + 1);
		var info = $.appInfo.add({
                timer   : 0,
                open    : false,
                showID  : false,
                type    : "loader",
                showmsgmeta : false,
                msg 	: "Chargement en cours",
                btClose : true
            })
		$.post(url, data, function(json) {
			onOpen(t);
			fileLocation = t.data("location");
			updLocation(fileLocation);
			editor.setOption("mode",mode[ext]);
			editor.setValue(json.data.fileContent);
			editor.clearHistory();
			
			bodyLockOff();
			$.appInfo.del(info);
		},"json");
	}
	return false;
})


function updLocation(location){
	var t = $("a#filelocation");
	t.html(location)
	.attr("href",t.data("webroot")+location)
	.attr("data-location",location);

}

$(document).on("click","a.cm-save",function (e){
	var url = $.routeExec("appfile_exec_save");

	e.preventDefault();	
	var t = $(this);
	var fileLocation = $("#filelocation").html();
	var fileContent = editor.getValue();


	var data = {
		file:fileLocation,
		fileContent:fileContent,
		fileMarks:""
	};
	
	var ext = fileLocation.substring(fileLocation.lastIndexOf('.') + 1);

	var info = $.appInfo.add({
                timer   : 0,
                open    : true,
                showID  : false,
                type    : "loader",
                msg		: "Enregistrement en cours",
                showmsgmeta : false,
                btClose : true
            })

	$.post(url, data, function(json) {
		bodyLockOff();
		if(json.infotype=="error"){
			var paramInfo = {
				btClose:true,
				timer   : 0,
				showmsgmeta : true,
				msgmeta : json.msgmeta,
				to:json.infotype,
				msg:json.msg
			};
		}
		else{
			var paramInfo = {
				timer   : 2500,
				showmsgmeta : true,
				msgmeta 	: fileLocation,
				to:json.infotype,
				msg:json.msg
			};
		}
		$.appInfo.upd(info,paramInfo);

	},"json");
	
	return false;
})

$('.app-generator').appLiveForm({
	callback:function(json,t){
		var info = $.appInfo.add({
                timer   : json.infotype,
                open    : true,
                showID  : false,
                type    : "success",
                msg		: json.msg,
                showmsgmeta : false,
                btClose : true
            })
	}
})
$("body").appView("appfile","circle-menu","",{
	callback:function (json,t){
		console.log(json);
	}
});

/*LES INCLUDES AVEC $.getScript(); */
	window.editor = editor;
	$.getScript("../app/appfile/js/app-codemirror-circlemenu.js",function(editor){

	});

});