$(document).ready(function($) {

function counter(){
	var tabsList = $('.nav-tabs').find('li');
		$.each(tabsList, function(index, val) {
			var t = $(val);
			var tabPaneID = t.find("a").attr("href");
			var len = $(tabPaneID).find(".search-show").length;
			t.find(".counter").html(len);
			// var len = $(val.find("a").attr("href")).find(".search-show").lenght;
			console.log();
		});

}
setTimeout(counter(),1500);


	$('#iconfinder').localsearch({onKeyUp:function(){
		counter();
	}});
});