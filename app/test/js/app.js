$(document).ready(function(){

$('#bt-save').appLiveExec({
	form:"#save",
	callback:function(json,t){
		t.after(json.data.url)
	}
});

function savePng(canvasID){
	var canvas 	= document.getElementById(canvasID);
	var context 	= canvas.getContext('2d');
	var canvasData 	= canvas.toDataURL("image/png");

	return canvasData;
}
i = 0;
x = i;
var step = 300;
	var d_canvas = document.getElementById('myCanvas');
var context = d_canvas.getContext('2d');
var param = {};

param.interval = setInterval(function(){
	// if(i<6000){
	if(i<6000){
	 	i = i+step;
	 	var background = document.getElementById('imgloop');
	 	context.clearRect(0, 0, 300, 300);
			context.drawImage(background, i, 0,300,300,0,0,300,300);
	var img = $("<input>",{"type":"hidden","name":"frame[]","value":savePng("myCanvas")});
	$(".result form").append(img);



	}
	else{
		i = 300;
		clearInterval(param.interval);
		$("#bt-save").trigger("click");
	}


	

},65);
	

var background = document.getElementById('imgloop');
context.drawImage(background, 300, 0,200,200);






});