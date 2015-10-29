$(document).ready(function($) {
	$(document).on("click",".img-preview",function (e){
		e.preventDefault();	
		var t = $(this);
		$(".onCur").removeClass("onCur");
		t.addClass('onCur');
		$('#preview').css({"background-image":t.css("background-image")});
		return false;
	})
$(document).on("mouseup",".img-preview",function (e){
	e.preventDefault();	
	var t = $(this);
	$('#frame').val(t.index());
	
})

	$('#frame').attr("max",$(".img-preview").length).width($(".img-preview").length*$(".img-preview").outerWidth());
	$(document).on("mousemove change","#frame",function (e){
		var t = $(this);
		var id = parseInt(t.val());
		id = id-1;
		// console.log();
		// 
		var curImg = $(".img-preview").eq(id);
		curImg.trigger("click");
		
		
	})
});