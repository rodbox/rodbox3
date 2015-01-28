$(document).ready(function(){
	$(document).on("keydown",function (e){
		console.log(e);
		$('#result').html(e.keyCode);
		// return false;
	})

});