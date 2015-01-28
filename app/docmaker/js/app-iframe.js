$(document).ready(function(){
	$.appiframe = function (url){
		// var btClose = $("<a>",{"href":"#","class":"bt-close pull-right"}).click(function(){
		// 	modal.remove();
		// 	return false;
		// }).html("X");
		// var modal = $("<div>",{"id":"#iframe","class":"modal-iframe"});
		// var iframe = $("<iframe>",{'src':url});

		// modal.append(btClose);
		// modal.append(iframe);
		// $(".page").append(modal);
		window.open(url,'_blank');
	}
});