$(document).ready(function(){

$(document).on("click",".toggle-ui",function (e){
	e.preventDefault();	
	var t = $(this);
	var navMode = (t.data("nav-mode"))?t.data("nav-mode"):"nav-mode-2";

	console.log(navMode);

	$('body').toggleClass(navMode);
	var data = {
		nav : $('body').attr("class")
	}
	$.get("../app/app-ui-session.php",data);
})

});