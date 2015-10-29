
	/*** Codemirror function ***/	
	editor = window.editor;
$("body").appView("appfile","circle-menu");
	/* Mouse menu */
	$(document).on("click tap",'.circle-center a',function (){
	    var mouseMenu = $('#circle-mouse');
	    mouseMenu.removeClass('open');
	})



    function toggleMouseMenu(posX,posY){
    		var cursor = editor.getCursor();
	    console.log(cursor);
    	var mouseMenu = $('#circle-mouse');
        if (!mouseMenu.hasClass('open')) {
            mouseMenu.css({
                left:posX+"px",
                top:posY+"px"
            }).show().addClass('open');
        }
        else
            mouseMenu.hide().removeClass('open');
    }
	/* End Mouse menu */



/*** FUNCTIONS ***/
	/* wrapp selection with content before and after */
	function wrappSelection(before,after,caret){
		
		var selection = editor.getSelection();
		var cursor = editor.getCursor();
		editor.replaceSelection(before+selection+after);
		editor.focus();

		/* setCursor after wrapped content */
		if(caret)
			cursor.ch = cursor.ch+caret;
		else if(selection=="")
			cursor.ch = cursor.ch+before.length;
		else
			cursor.ch = cursor.ch+before.length+after.length;
		editor.setCursor(cursor);
	}

	/*  */
	function rate(star,id){
		var star = "/**["+star+"]**/";
		var selection = editor.getSelection();
		editor.replaceSelection(star+selection);
	}
/*** END FUNCTIONS ***/




/*** EVENTS ***/
	$(document).on("click",".wrap",function (e){
		e.preventDefault();
		var t = $(this);
		var before = t.data("before").replace("\\","");
		var after = t.data("after").replace("\\","");
		var caret = t.data("caret");
		wrappSelection(before,after,caret);
	})


	/* Execute une fonction de code mirror */
	/* Voir la liste sur : http://codemirror.net/doc/manual.html#api */
	$(document).on("click",".cm-func",function (e){
		e.preventDefault();	
		var t = $(this);
		var req = t.data("req");
		eval("editor."+req+"()");
	})

	/* request location */
	$(document).on("click",".req",function (e){
		e.preventDefault();
		var t = $(this);
		var selection  = editor.getSelection();
		
		var url = t.attr("href");
		var req = t.data("req");
		if(selection!="" && req){
			var req = req.replace("[selection]",selection);
			var url=url+req;
		}
		window.open(url,'_blank');
	})

	/* alias */
	$(document).on("click",".alias",function (e){
		e.preventDefault();	
		var t = $(this);
		$(t.attr("href")).trigger("click");
	})

	/* Mark text */
	$(document).on("click",".star",function (e){
		e.preventDefault();	
		var t = $(this);
		var selection = editor.getSelection();

		$(".form-msg").show().css({
			left:e.pageX,
			top:e.pageY
		});
		$('#item-addmsg').val(selection);
		$('#item-addmsgID').val(parseInt($('#item-addmsgID').val())+1);
		toggleMouseMenu();

		console.log(e);

		console.log(selection);
	})
	$('form.form-addmsg').appLiveForm({
		callback:function (json,t){
			$(".form-msg").hide();
		}
	});
	$('.form-msg').draggable();


	
/*** END EVENTS ***/

