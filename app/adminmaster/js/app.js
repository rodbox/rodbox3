$(document).ready(function() {
$('.bt-clearLog, .bt-refreshLog').appLiveExec({
	callback:function (json,t){
		$('pre').html(json.app);
	}
})



	$('.data-table').DataTable({
		"pageLength": 7,
		"language": {
    		"paginate": {
      			"first": "<<",
      			"next": ">",
      			"previous": "<",
      			"last": ">>"
    		}
    	}
	}).on( 'draw', function () {
    $(".selectpicker").selectpicker();
} );

$(document).on("click",".toggle-portlet-fullscreen",function (e){
	e.preventDefault();	
	var portlet = $(this).parents(".portlet");
	portlet.toggleClass("portlet-fullscreen");

	if (portlet.hasClass('portlet-fullscreen'))
		$("body").addClass('overflow-hidden');
	else
		$("body").removeClass('overflow-hidden');
})
$(document).on("click",".toggle-portlet-footer",function (e){
	e.preventDefault();	
	$(this).parents(".portlet").toggleClass("portlet-footer-active");
})


$('.applivebt').appLiveExec({
	info:false,
	callback:function(json,t){
		t.after(json.content);
		t.remove();
	}
})
$(".appliveformMsg").appLiveForm({
	callback:function (json,t){
		t.find(".counterProgress").counterProgress();
	}
})

$(document).on("change",".applive-setRole_route *",function (e){
	e.preventDefault();	
	var t = $(this);
	t.parents("form").addClass("onChange");
})
$('.applive-setRole_route').appLiveForm({
	callback:function (json,t){
		t.removeClass("onChange");
	}
})

$('.counterProgress').counterProgress();

$(document).on("change",".filter-lang",function (e){
	e.preventDefault();	
	var t = $(this);
	if (t.prop("checked")==true) {
		$(".lang-"+t.data("lang")).show();
	}
else{
	$(".lang-"+t.data("lang")).hide();
	// console.log(t);
}
	
})




});