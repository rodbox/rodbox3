$(document).ready(function(){

$('.plupload').plupload({
	setData : function(){
		/* Require appserializeObject.js sur static.rodbox.fr */
		var datasend = $('#ressource-select').serializeObject();

		return datasend;
	},
	resize 	: {"width":2000, "height": 2000, "quality": 100},
	'drop_title':'<i class="glyphicon glyphicon-cloud-upload"></i><br><span class="small">Ajoutez vos sprites !</span>',
	callbackFileUploaded:function(r){

		var animList = $('#select-anim');
		
	}
})



});