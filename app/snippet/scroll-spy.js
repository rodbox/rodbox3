$(document).ready(function() {
	var scrollSpy  = $('#scroll-spy');
	scrollSpy.data("posY",scrollSpy.position().top);
	scrollSpy.data("h",scrollSpy.outerHeight());
	scrollSpy.data("w",scrollSpy.outerWidth());
	var placeholderSpy = $("<div>",{"id":"placeholder"}).height(scrollSpy.outerHeight()).html(" ");

	$('#snippet-list-col').on($.getScrollEvent(),function (e){
		var t = $(this);
		var target = t.find("#scroll-spy");
		var st = t.scrollTop();

		if(st > target.data("posY")){
			target.addClass("fixed").css({
				'margin-top':0-(target.data("posY")+target.data("h")),
				'width':target.data("w")
			});
			t.addClass('active');
			target.before(placeholderSpy);
		}
		else{
			target.removeClass("fixed").css({'margin-top':0,'width':'inherit'});
			t.removeClass('active').css({'padding-top':0});
			placeholderSpy.remove();
		}
	})

	$(window).resize(function (e){
		var scrollSpy  = $('#scroll-spy');

		scrollSpy.data("h",scrollSpy.outerHeight());
		scrollSpy.data("w",scrollSpy.outerWidth());
		// var placeholderSpy = $("<div>",{"id":"placeholder"}).height(scrollSpy.outerHeight()).html(" ");
		
	})
});