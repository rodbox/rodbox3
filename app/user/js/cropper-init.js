$(document).ready(function($) {
	$(document).on("click",".bt-modal-route",function (e){
		$.routeModal("user_view_crop_img","",function(json){
			var img = $(".cropper img");

			img.cropper({
				guides: false,
				strict: true,
				highlight: false,
				dragCrop: false,
				movable: false,
				resizable: false,
				guides: true,
				aspectRatio: 1/1,
		    	global: false,
		    	minContainerWidth:500,
		    	minContainerHeight:500,
		    	preview:".preview"
		  });

			$("#cropValid").on("click",function (e){
				e.preventDefault();	
				var t = $(this);
				var data = {
					"img":img.cropper('getImageData'),
					"crop":img.cropper('getCropBoxData'),
					"data":img.cropper('getData')
				};

				var url = $.routeExec("user_exec_crop_img");
				$.post(url, data, function(json, textStatus, xhr) {
					if(json.infotype=='success'){
						$('.user-img').css("background-image","url("+json.data+")");
						$("#myModal").modal("hide");
						img.cropper('destroy');
						t.off();
					}
					else{
						$('.meta').html("error");
					}

				},"JSON").error(function (info){
					$('.meta').html(info.responseText);
				});
				return false;
			});

			var param = {};
			$('.crop-tool').on("mousedown mouseup",function (e){
				var t = $(this);
				var option = t.data("option");
				var value = t.data("value");
				if(e.type == "mousedown"){
					param.interval = setInterval(function (){
						img.cropper(option, value);
					},50)
				}
				else
					clearInterval(param.interval);
			})



		});
	})


});