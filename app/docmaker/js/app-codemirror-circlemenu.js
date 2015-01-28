/*** Codemirror function ***/

	editor = window.editor;



	/* Mouse menu */
	$(document).on("click tap",'.circle-center a',function (){
	    var mouseMenu = $('#circle-mouse');
	    mouseMenu.removeClass('open');
	})

	$(document).on("mousedown","#circle-mouse",function (e){
		if (e.button == 2) {
            toggleMouseMenu(e.clientX,e.clientY);
            $(document)[0].oncontextmenu = function() {
                return false;
            }
        }
	})

    function toggleMouseMenu(posX,posY){
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
	function wrappSelection(before,after){
		
		var selection = editor.getSelection();
		var cursor = editor.getCursor();
		editor.replaceSelection(before+selection+after);
		editor.focus();

		/* setCursor after wrapped content */
		if(selection=="")
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
		wrappSelection(before,after);
	})

	/* star */
	$(document).on("click",".star",function (e){
		e.preventDefault();	
		var t = $(this);
		rate(t.data("star"),0);
	})

	/* google */
	$(document).on("click","#google",function (e){
		e.preventDefault();
		var t = $(this);
		var selection  = editor.getSelection();
		
		var url = "https://www.google.fr/search?q="+selection;
		if(selection!="")
			$.appiframe(url);

	})

	/* google translate */
	$(document).on("click","#translate",function (e){
		e.preventDefault();	
		var t = $(this);
		var selection  = editor.getSelection();
		var url = "https://translate.google.fr/#en/fr/"+selection;
		if(selection!="")
			$.appiframe(url);
	})
/*** END EVENTS ***/
