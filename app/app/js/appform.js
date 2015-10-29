$(document).ready(function($) {
		
	$(".form-step-list .form-step-current a").popover('show');
	/* FORM STEP */
	$(document).on("click",".form-step-button",function (e){
	  e.preventDefault();  
	  var t = $(this);
	  var stepID = t.attr("href");
	  var stepIDHeader = stepID+"-header";

	  validate = $.validateStep($('.form-step-body.form-step-current').attr("id"));

	  if(t.hasClass("form-step-button-prev")){
	  		$('.form-step-current').removeClass("form-step-check");
		    $('.form-step-current a').popover('hide');
		    $('.form-step-current').removeClass("form-step-current");

		    $(stepID).addClass("form-step-current");
		    $(stepIDHeader).addClass("form-step-current").removeClass("form-step-check").find("a").popover('show');
	    }
	  else{
	  	 if(validate){
		 	$('.form-step-current').addClass("form-step-check");
			$('.form-step-current a').popover('hide');
			$('.form-step-current').removeClass("form-step-current");

		    $(stepID).addClass("form-step-current");
		    $(stepIDHeader).addClass("form-step-current").removeClass("form-step-check").find("a").popover('show');
		  }
	  }
	})

	$(document).on("focusin focusout",".form-item input, .form-item textarea,.form-item select",function (e){
	  e.preventDefault();  
	  var t = $(this);
	  var p = t.parent(".form-item");
	  if(e.type=="focusin"){
	  	p.addClass('form-item-focus');
	  	if($.evalToggle("helper"))
			p.find("a.bt-popover").popover('show');
		}
		else{
			p.removeClass('form-item-focus');
			if(t.val()!="")
				p.removeClass('form-item-empty');
			else
				p.addClass('form-item-empty');

			p.find("a.bt-popover").popover('hide');
		}
	})

	$(document).on("keyup","#User",function (e){
		e.preventDefault();  
		var t = $(this);
	})
});