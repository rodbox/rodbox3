$(document).ready(function(){



$(document).on("click",".list-icon li",function (e){
	// alert("klm");
	var hex = 'content:'+$(this).find("i").data('hex')+';';
	var font = 'font-family: "'+$(this).parent("ul.list-icon").data('font')+'";';

	prompt("css content hex",font+"\n"+hex);
	
})
	$(document).on("click","#export-pdf",function (e){
		var t = $(this);

		// var data  = $('#form-snippets-list').serialize();
		var data  = $('#config-pdf').serialize();
		t.addClass("onLoad");
		// var data = data+"&"+dataExport;
		$.get(t.attr("href"),data, function(json) {
			t.removeClass("onLoad");
			window.location.href = json.data.url;
		},'json');
		return false;
	})

/* for icon finder */
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