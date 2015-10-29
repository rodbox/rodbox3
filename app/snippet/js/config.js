$(document).ready(function(){

$(document).on("click","#category-add",function (e){
	var t = $(this);
	var clone = $(".category-line").first().clone()
	clone.find("input").val("");
	$('#category-list tbody').append(clone);
	console.log(clone);
	return false;
})

$(document).on("click",".remove-line",function (e){
	e.preventDefault();	
	var t = $(this);
	var p = t.parents("tr").remove();
	
})

$(document).on("submit","#config-save",function (e){
	var t = $(this);
	var data = t.serialize();
	var url = t.attr("action");
	t.find("#config-submit").loadOn();

	$.get(url,data, function(json) {
		t.find("#config-submit").loadOff();
		var r = $("<div>",{"id":"result","class":"inline msg-" + json.infotype}).html(json.msg);
		t.append(r);
		setTimeout(function(){
			r.remove()
		},2000);
	},"JSON");

	return false;
})

});