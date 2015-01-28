$(document).ready(function(){
	
	/* On initialise l'ecoute des touches de raccourcis alternative */
	$("body").appaltkey();
	$("#snippets-finder").localsearch();
	$("#snippets-finder").appkeynav();

	$('textarea.caretposition').appcaret();


	$(document).on("submit","#tab-helper",function (){
		var t 		= $(this);
		var num 	= t.find("[name=tabNum]");
		var content = t.find("[name=tabContent]");

		var contentVal = (content.val()=="")?"":":"+content.val();
		var tab 	= "${"+num.val()+contentVal+"}";

		content.val("");
		num.val(parseInt(num.val())+1);


		editor.replaceSelection(tab);
		editor.focus();
		
		$.appfollow.hide();

		return false;
	})


	/* pour editer un snippet */
	$(document).on("click",".snippet-edit",function (){
		var t = $(this);
		$(".colpage").removeClass("responseMode");
		$.get(t.attr("href"), function(xml) {
			t.parents("ul").find(".onOpen").removeClass('onOpen');
			t.parent("li").addClass("onOpen");

			t.parents("ul").find(".onFocus").removeClass('onFocus');
			t.parent("li").addClass("onFocus");
			speedSelect(t.parent("li"),true);
			var xml 	= $(xml);
			var form 	= $('form#snippet-editor')
			var content = xml.find("content").text();

			var tabTrigger 	= xml.find("tabTrigger").text();
			var scope 		= xml.find("scope").text();
			var description = xml.find("description").text();
			var category 	= xml.find("category").text();

			var name 		= t.data("filename");

			form.attr("data-new",false);
			form.find("textarea[name=content]").val(content);

			form.find("input[name=snippetName]").val(name);
			form.find("input[name=trigger]").val(tabTrigger);
			form.find("input[name=desc]").val(description);
			form.find("select[name=type]").val(scope);
			form.find("select[name=category]").val(category);
			form.find("textarea[name=content]").val(content);

			$("#snippet-del").attr("data-snippetname",name);
			$("#snippet-del").show();

 			editor.setValue(content);
 			editor.setOption("mode",scope);
 			$.appfollow.hide();
 			$('#category').trigger("change");
		},'XML');
		return false;
	})

	$(document).on("click","#snippet-new",function (){
		var t = $(this);
		var form = t.parent("form");

		form.find("textarea, input, select").val("");
		form.attr("data-new",true);

		$(".bt-snippet-del").data("snippetname","").hide();
		$("#tab-helper").val(1);
		$('.onOpen').removeClass("onOpen");
		$("#category").val("all").trigger("change");
		editor.setValue("");
		$.appfollow.hide();
		return false;
	});


	$(document).on("submit","#snippet-editor",function (){
		var t = $(this);
		var action = t.attr("action");
		$.post(action, t.serialize(), function(json) {

			t.parents(".colpage").addClass("responseMode");
			$('.toggle-response').attr("href",json.data.url);
			$('#filename-response').html(json.data.name);
			$('#filename-response').attr("download",json.data.file);

			/* On ajoute le nouveau snippet a la list */
			if(t.data("new")){
				var file = $("input[name='snippetname']").val();
				var newSnippet  = $('#liModel').clone().attr({"id":json.data.name}).show().prop('outerHTML');
				newSnippet = newSnippet.replace(/\[FILE\]/g,json.data.name);
				$('#snippets-list').prepend(newSnippet);
				snippetCount(1);
				
			}
			
		},"JSON");
		return false;
	})

	$(document).on("click",".toggle-response",function (){
		var t = $(this);
		t.parents(".colpage").toggleClass("responseMode");
		$('#snippet-editor input').first().focus();
		
	})
	

	$(document).on("click",".bt-close-response",function (){
		var t = $(this);
		t.parents(".colpage").removeClass("responseMode");
		return false;
	})

	function snippetCount(val){
		$("#snippets-count").html(parseInt($("#snippets-count").html())+val);
	}

/* CODE MIRROR  */
	var editor = CodeMirror.fromTextArea(myTextarea, {
	    theme 			: "elegant",
	    lineNumbers		: true,
	    tabSize			: 8,
	    lineWrapping	: true,
	    mode			: "php",
	    matchBrackets	: true
	});
	/* Mise a jour du textarea d'origine */
	editor.on("change",function(editor, change){
	    editor.save();
	});

	/* Gestion des raccourcis clavier */
	editor.on("keydown",function(editor, e){
	    if ($.evalAlt("onAlt") && e.keyCode == 40){
	    	$.appfollow.active();
			$("#tabNum").focus();
			$("#sub").addClass("active");
			return false;
		}
	});



	/* Déplacer le follower */
	function followCode(editor){
		var pos = editor.cursorCoords();
		var cmp  = $(".CodeMirror").position();
		var cmo  = $(".CodeMirror").offset();
		$.appfollow.set(pos.top-25,pos.left-cmo.left-30);
	}

	editor.on("cursorActivity",function(editor, e){
		followCode(editor)
	});

	editor.on("focus",function(editor, e){
		$.appfollow.active();
		followCode(editor);
	});



	editor.on("scroll",function(editor, e){
		followCode(editor)
	});

	$(document).on("click","#snippet-del",function (e){

		e.preventDefault();	
		var t = $(this);
		if(confirm("Confirmez la supression ?")){
			var data = {
				'snippetname': t.attr("data-snippetname")
			}
			$.get(t.attr("href"),data,function(json){
				$("#"+t.attr("data-snippetname")).remove();

				$('#snippet-new').trigger('click');
				snippetCount(-1);
			},'json')
		}
	})


	/* Gestion de la liste de snippet */
	function counterCheck(){
		var checked = $('#form-snippets-list').find(":checked");

		$('#form-snippets-list').find("li").removeClass("onChecked");
		checked.parents("li").addClass("onChecked");

		var c = checked.length;
		$('#countselect').html(c);
		$('#snippets-count').html($('#form-snippets-list').find("li").length);
		return c;
	}

	$(document).on("click keyup","#form-snippets-list",function (e){
		counterCheck()
	})



	$(document).on("click","#snippets-zip",function (e){
		var t = $(this);
		var data  = $('#form-snippets-list').serialize();
		t.loadOn();
		$.get(t.attr("href"),data, function(json) {
			t.loadOff();
			window.location.href = json.data.url;
		},'json');
		return false;
	})
console.log(localStorage);



	$(document).on("click","#snippets-config-pdf",function (e){
		
		
	})

	$(document).on("click","#snippets-pdf",function (e){
		var t = $(this);

		if (counterCheck()==0)
			$('#snippets-toggle').trigger("click");


		var data  = $('#form-snippets-list').serialize();
		var dataExport  = $('#config-pdf').serialize();
		t.loadOn();
		$('#config-pdf').FormCache();
		

		var data = data+"&"+dataExport;
		$.get(t.attr("href"),data, function(json) {
			t.loadOff();
			window.location.href = json.data.url;
		},'json');
		return false;
	})


	$(document).on("change","select[name=type]",function (e){
		// e.preventDefault();	
		var t = $(this);
		editor.setOption("mode",t.val());
	})


/* Speed selection */
function speedSelectMode(active,src){
	var src = (src)?src:"all";
	if(active)
		$('#form-snippets-list').addClass("onSpeedSelect").addClass("onSpeedSelect-"+src);
	else
		$('#form-snippets-list').removeClass("onSpeedSelect").removeClass("onSpeedSelect-"+src);
}
function speedSelectEval(src){
	if (src)
		return $('#form-snippets-list').hasClass("onSpeedSelect-"+src);
	else
		return $('#form-snippets-list').hasClass("onSpeedSelect");
}
function speedSelect(t,force){
	console.log();
	checkbox = t.find("input[type=checkbox]");
	if(typeof(force)!="boolean"){
		var isChecked = checkbox.is(':checked');
		if(isChecked){
			t.removeClass('onChecked');
			checkbox.prop('checked',false);
		}
		else{
			t.addClass('onChecked');
			checkbox.prop('checked', true);
		}
	}
	else{
		if(force){
			t.addClass('onChecked');
			checkbox.prop('checked',true);
		}
		else{
			t.addClass('onChecked');
			checkbox.prop('checked', false);
		}
	}
			counterCheck();
}
	$(document).on("mouseleave","#form-snippets-list",function (e){
		speedSelectMode(false);
		counterCheck();
	})
	$(document).on("mousedown mouseenter mouseup","#form-snippets-list li ",function (e){
		var t = $(this);
		
		if(e.type=="mousedown"){
			speedSelectMode(true,'mouse');
			speedSelect(t);
		}
		else if(e.type=="mouseup"){
			speedSelectMode(false,'mouse');
		}
		else{
			if(speedSelectEval('mouse'))
				speedSelect(t);
		}
		
		counterCheck();
	})

	$(document).on("click","#snippets-toggle",function (e){
		var t = $(this);
		t.toggleClass("onActive");
		var list = $("#form-snippets-list li.search-show");
		/* si onActive on check sinon non */
		speedSelect(list,t.hasClass('onActive'))

		return false;
	})
	/* Pour gerer le cache des modals */
	$(document).on("click",".bt-modal",function (e){
		var t = $(this);
		$.get(t.attr("href"), function(html) {
			$('.modal-content').html(html)
		});

		return false;
	})

	$(document).on("change keyup",".c-preview-value",function (e){
		var t = $(this);
		t.prev(".c-preview").css("background-color",t.val());
	})
	$(document).on("change keyup","#category",function (e){
		var t = $(this);
		var json = t.data("config");
		var color = json.category[t.val()].color;
		$("#color-rect").css("background-color",color);
		var p = t.parents(".line-9");
		// $('#border-preview').css("border-color",color);
		p.css({"border-right":"8px solid "+color});
		$('.border-preview,.CodeMirror').css("border","0px solid "+color);
	})

	if($.appMobile()){
		$(document).on("tap","label",function (e){
			e.preventDefault();	
			var t = $(this);
			t.trigger("click");
			
		})
	}

	$(document).on("click","#snippets-toggle-views",function (e){
		e.preventDefault();	
		var t = $(this);
		t.toggleClass("onToggle");

		if(t.hasClass("onToggle")){
			t.find("i").removeClass("glyphicon-eye-open").addClass("glyphicon-eye-close");
			$('#form-snippets-list').find("li").not("#liModel").hide();
			$('#form-snippets-list').find("li.onChecked").not("#liModel").show();
		}
		else{
			t.find("i").addClass("glyphicon-eye-open").removeClass("glyphicon-eye-close");
			$('#form-snippets-list').find("li").not("#liModel").show();
		}
		
		return false;
	})

	$(document).on("keydown keyup","#snippets-finder",function (e){
		if (e.keyCode=="18"){

			speedSelectMode(e.type=="keydown","key");
		}
		else if (e.keyCode=="38"||e.keyCode=="40"){
			if(speedSelectEval("key"))
				speedSelect($(".onFocus"));
			
		}

	})

});