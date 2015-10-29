$(document).ready(function($) {
$(document).on("click",".target-focus",function (e){
	e.preventDefault();	
	var t = $(this);
	var name = t.data("focus");
	$("[name="+name+"]").focus();
	
})

$('.applive-formUser').appLiveForm({
	error:function (json,t){
		
	},
	success:function (json,t){
		t.slideUp(250,function (){
			$.redirectRoutePage("app_page_index");
		})
	}
});

  $('#formLogin').appLiveForm({
    info:false,
    validate:true,
    callback:function (json,t){
      if(json.infotype=="success"){
        $.redirectRoutePage(json.data.route);
      }
      else{
        $.redirectRoutePage(json.data.route);
      }
  }});
$('#formUser').find(".form-item-alert .bt-popover").trigger('mouseover');





var param = {};

param.time="";

$(document).on("keyup","#formUser input#User",function (e){
	e.preventDefault();	
	var t = $(this);
	t.next(".msg").remove();
	clearTimeout(param.time);
	param.time = setTimeout(function (){
		var r = $.service("userExist",t.val(),function(dataService){
			if(dataService.data){
				t.parents(".form-item").addClass("form-item-alert");
				t.after("<span class='msg-error msg'><i class='icomoon-warning '></i> "+dataService.msg+"</span>");
			}
			else{
				t.after("<span class='msg-valid msg'><i class='icomoon-checkmark4'></i> "+dataService.msg+"</span>");
			}

			console.log(dataService.msg);
		});

	},1500)
	
})
$('.rotate-user-img').appLiveExec({
	callback:function (json,t){
		$('.user-img').css("background-image","url("+json.data+")");
	}
})

$("#upload-progress").knob({
	"skin":"tron",
	"displayInput":false,
	"thickness":".15",
	"width":200,
	"bgColor":"#242424",
	"readOnly":true
})
// var i = 0;
// param.loop = setInterval(function (){
// 	$("#upload-progress").val(i++).trigger("change");
// 	if(i>100){
// 		clearInterval(param.loop);
// 		$("#upload-progress").val(0).trigger("change");
// 		// alert("done");
// 	}
// },20);



});