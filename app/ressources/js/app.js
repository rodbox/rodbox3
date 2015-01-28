$(document).ready(function(){
var param = {};



$.each($(".slider-master"), function(index, val) {
	var t = $(val);
	var min = t.attr("min");
	var max = t.attr("max");

	var output = $("<output>",{
		'for'		: t.attr("id"),
		'data-min'	: min,
		'data-max'	: max
	});
	var divContain = $("<div>",{"class":"div-range"});
	var spanMin = $("<span>",{class:"output-min"}).html(min);
	var spanMax = $("<span>",{class:"output-max"}).html(max);

	t.wrap(divContain);

	var value 	= t.val();

	t.before(spanMin);
	t.after(spanMax);
	spanMax.after(output);
	t.on("change mousemove",function(){
		var t = $(this);
		output.val(t.val());
	})
});


$('#fps').on("change mousemove",function(){
	var t = $(this);
	param.fps = 1000/t.val();
	if(param.playMode){
		loopOff();
		loopOn(param.curFrame);
	}
});


function init(){
	param.sprites = $('.sprites-list li');
	param.nbFrames = param.sprites.length;
	param.fps = 1000/$('#fps').val();

	param.sprites.first().addClass("cur-frame");

	var nb

	$('#frames').attr("max",param.nbFrames-1).val(0).on("change mousemove keydown",function(){
	var t = $(this);
	frame(t.val());
});
}

function frame(index){
	index = index;
	$(".cur-frame").removeClass("cur-frame");
	param.sprites.eq(index).addClass("cur-frame");
	var id = "frames";
	$('#'+id).val(index);
	$('[for='+id+']').val(index);

	

	param.curFrame = index;
}

function loopOn(i){
	param.playMode = true;
	param.playLoop = setInterval(function(){
		i++;
		if(i>=param.nbFrames)
			i=1;
		frame(i);
	},param.fps);
}

function loopOff(){
	param.playMode = false;
	clearInterval(param.playLoop);
	console.log(param.sprites.hasClass("cur-frame"));
}

$("#bt-play").click(function (){
	var t = $(this);
	var i = (!param.curFrame)?1:param.curFrame;
	if(!t.hasClass("active"))
		loopOn(i);
	else
		loopOff();
});


$('#ressource-open').appLiveExec({
	form:"#ressource-select",
	callback:function(json,t){
		$('.sprites-list').html("");
		$.each(json.data.list, function(index, val) {
			var li = $("<li>");
			var img = $("<img>",{"src":json.data.url+val});
			li.html(img);
			$('.sprites-list').append(li);
		});
		init();
	}
});

$('#select-perso').appLiveExec({
	event:"change",
	form:"#ressource-select",
	callback:function(json,t){
		$('#select-anim').html("");
		$.each(json.data.list, function(index, val) {
			var option = $("<option>",{
				value:val
				}).html(val);
			$('#select-anim').append(option);
		});
		$('.selectpicker').selectpicker('refresh');
		init();
	}
});

$('#bt-additem').appLiveExec({
	form:"#ressource-select",
	callback:function(json,t){
		var val = $('#additem').val()
		var option = $("<option>",{value:val}).html(val);
		$('#select-perso').append(option);
		$('.selectpicker').selectpicker('refresh');
		$('#additem').val("");
	}
});

$('#bt-addanim').appLiveExec({
	form:"#ressource-select",
	callback:function(json,t){
		var val = $('#addanim').val()
		var option = $("<option>",{value:val}).html(val);
		$('#select-anim').append(option);
		$('.selectpicker').selectpicker('refresh');
		$('#addanim').val("");
	}
});


$('#uploadanim').appLiveExec({
	form:"#ressource-select",
	callback:function(json,t){
		
	}
});

$(document).on("change","#select-anim",function (e){
	$('#ressource-open').trigger("click");
})

$('#select-perso').trigger("change");


/* gestion du toggle group  */
/* => bouton ajouter a coté des <select> */
$(document).on("click",".btn-toggle-group",function (e){
	e.preventDefault();	
	var t = $(this);
	$(t.attr("href")).toggleClass("toggle-group").find('input').first().keypress(function(e){
		if(e.keyCode=="13")
			var t = $(this).next('a').trigger("click");
	}).focus();
	
})

});