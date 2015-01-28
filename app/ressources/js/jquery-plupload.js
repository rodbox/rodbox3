$(function() {

	$.fn.plupload=function(paramSend){

	var selector = this.selector.substring(1,this.selector.length);

		var defauts = {
		url				: $(this).attr("action"),
		containes		: selector,
		drop_title		: "Drop files",
		file_list		: selector+"-plupload-file-list",
		meta_upload		: selector+"-plupload-meta",
		browse_button	: selector+"-plupload-browse",
		drop_element	: selector+"-plupload-dropzone",
		urlstream_upload: true,
		resize 			: {"width":1200, "height": 1000, "quality": 90},
		runtimes		: "html5,flash",
		flash_swf_url	: "plupload/js/Moxie.swf",
		setData			: function(){
			return [{delafunk:"delafunk"}];
		},
		multipart		: true,
		multipart_params: [{directory:"test"}],
		views: {
            list	: true,
            thumbs	: true, // Show thumbs
            active	: 'thumbs'
        },
		multi_selection : true,
		startOnAdded	: true,

		FilesAdded		: function (up, files, uploader){
			uploader.setOption('multipart_params',param.setData());
			createLine (up,files,uploader);
			uploader.refresh();
			uploaderStart(uploader);
		},
		UploadProgress 	: function (up, file, uploader){
			var fileCurrent = $("#"+file.id)
			if (!fileCurrent.hasClass("upload-current"))
				fileCurrent.addClass("upload-current");

			fileCurrent.find(".progress").stop().css({'width':file.percent+"%"});
		},
		FileUploaded	: function (up, file, data, uploader){
			var fileCurrent = $("#"+file.id);
			fileCurrent.addClass("upload-complete").slideUp( function (){
					$(this).remove();
					metaUpload();
			});
			param.callbackFileUploaded(data);
		},
		createLine		: function (up, files, uploader){
			var filelist = $("#"+param.file_list);
			// var filelist = $(this.selector);
			for(var i in files){
				var file = files[i];

				var progress = $("<div>",{class:"progress"});
				var progressBar = $("<div>",{class:"progressBar"}).append(progress);
				// var view = $("<div>",{class:"progressBar"}).append(progress);
				var del = $("<a>",{class:"plupload_delete bg-10 c-1"}).append("x").click(function(t){
					var t = $(this);

					var id = file.id;
					// up.removeFile(file);
					uploader.removeFile(file);

					return false;
				});

				var line = $("<div>",{
					id  	: file.id,
					class	: "file",
					html 	: "<div class='img-title'>"+file.name+" <span class='small file-size'>("+plupload.formatSize(file.size)+")</span></div>"
				}).append(progressBar);
				filelist.append(line);

			}
			metaUpload();
		}
        };

	var param	= $.extend(defauts, paramSend);

	createDrop(this.selector,param);

	var uploader	= new plupload.Uploader(param);

	uploader.init();

	uploader.bind('FilesAdded',function(up,files){
		param.FilesAdded(up,files,uploader);
	});

	uploader.bind("UploadProgress",function(up, file){
		param.UploadProgress(up,file,uploader);
	})

	uploader.bind("FileUploaded",function (up, file, data){
		param.FileUploaded(up,file,data,uploader);
	})


	var t = $(this);

	function metaUpload(){
		var metaUpload = $("#"+param.meta_upload);
		var filelist = $("#"+param.file_list);
		var files = filelist.find(".file");
		var countFiles = files.length;
		if (countFiles > 0){
			content = "reste : " + countFiles;
			metaUpload.html(content);
		}
		else{
			metaUpload.html("");
			$("body").removeClass("onLoad");
		}
	}

	function data(){
		$.each(param.data_eval, function(index, val) {
			param.data_eval[index] = eval(val);
		});
		param.data 	=$.extend(param.data, param.data_eval);
		uploader.settings.multipart_params = param.data
	}

	function uploaderStart(uploader){
		$("body").addClass("onLoad");

		uploader.start();
	}

	function createDrop(selector,param){
		var fileList 	= $("<div>",{
			"id"	: param.file_list,
			"class"	: "plupload-file-list"});

		var metaUpload 	= $("<div>",{
			"id"	: param.meta_upload,
			"class"	: "plupload-meta-upload"});

		var browse 	= $("<a>",{
			"id"	: param.browse_button,
			"class"	: "bt-browse"
		}).html(param.drop_title);

		var drop 	= $("<div>",{
			"id"	: param.drop_element,
			"class"	: "plupload-drop-zone"
		}).append(browse);

		$(selector).html(drop).append(metaUpload).append(fileList);
	}


	function createLine (up,files,uploader){
		param.createLine(up,files,uploader);
	}




	$(document).on("click",".plupload_delete",function (){
		uploader.bind("FilesRemoved",function (up, file, data){
			param.FileUploaded(up,file,data,uploader);
		})
	})

}


});