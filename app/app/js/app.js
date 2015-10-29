$(document).ready(function(){

$.appInfo.init();

$.route =  function (){
  var url = 'http://192.168.1.44/rodbox3';
  return url;
}

/* Gestion des routes avec Jquery */
$.routeExec = function (route,q){
  var q = (q!=undefined)?"&"+$.param(q):"";
  return $.route()+"/app/app-exec.php?route="+route+q;
}
$.routePage = function (route,q){
  var q = (q!=undefined)?"&"+$.param(q):"";
  return $.route()+"/web/?route="+route+q;
}
$.routeView = function (){
  return $.route()+"/app/app-view.php";
}
/**
 * execute un service depuis le front
 * @param  {string} service     nom d'un service referencer
 * @param  {string|json} dataService param envoyer au service
 * @param  {function} callback function de retour de fin de service
 * @return {[type]}             le retour du callback
 */
$.service = function (service,dataService,callback){
  if(callback == undefined)
    callback = function(){};

  var url = $.route()+"/app/app-service.php";
  var data = {
    service : service,
    data : dataService
  }

  $.post(url, data, function(data, textStatus, xhr) {
    callback(data);
  },"JSON");
}

$.routeModal = function (route,q,callback){
    var url = $.route()+"/app/app-route.php";
    var data = {
      route : route,
      send:q
    }

  $.post(url, data, function(json) {
    $('#modal-title').html(json.title);
    $('#modal-body').html(json.content);
    $('#myModal').modal();
      callback(json);
    },"JSON");
}

$.redirectRoutePage = function (route,q){
  var url = $.routePage(route);
  var q = (q!=undefined)?"&"+$.param(q):"";

   $.redirect(url+q);
}

/* END Gestion des routes avec Jquery */
$.redirect = function(url) {
    localStorage.current = url;
    window.location.href = url;
};

// /* FullMsg */
// $.fullmsg = {
//     intro : function(msg,options){
//       var defauts=
//             {
//               delay : 2000,
//               outroDelay : 1300,
//               callback:function(t){}
//             };
//     var param=$.extend(defauts, options);
//     var msgContainer = $("<div>",{"id":"fullmsg","class":"fullmsg-container"});
//     var p = $("<p>").html(msg);

//     msgContainer.append(p);
//     $('body').prepend(msgContainer);
//     setTimeout(function(){
//       msgContainer.addClass("open");
//     },100);

//     setTimeout(function(){
//       msgContainer.find("p").addClass("outro");
//           setTimeout(function(){
//             param.callback(msgContainer);
//           },param.delay*0.8)
//     },param.delay)


//   },
//   outro : function (){
//     msgContainer = $("#fullmsg");
//      setTimeout(function(){
//       msgContainer.addClass("putToBottom");
//         setTimeout(function(){
//           msgContainer.remove();  
//         },2000);
//     },100);
//   }
// };

// $.fullmsg.outro();
// /* END FullMsg */

/* LOCK AND LOAD */
$.fn.lockOn=function(){
  $(this).attr("disabled","disabled").addClass("onLock");
}
$.fn.lockOff=function(){
  $(this).removeAttr("disabled").removeClass("onLock");
}
$.fn.loadOn=function(){
  var t = $(this);
  t.attr("data-html",t.val());
  t.addClass("onLoad").lockOn();

  t.val("En chargement");
}
$.fn.loadOff=function(){
  var t = $(this);
  t.removeClass("onLoad").lockOff();
  t.val(t.data("html"));
}
/* END LOCK AND LOAD */



  $('.appliveform').appLiveForm();
  $('.appliveexec').appLiveExec();


  
  $('.user-disconnect').appLiveExec({
    info:false,
    callback:function (json,t){
      $.redirectRoutePage(json.data.route);
  }});


$(document).on("change",".submitOnChange",function (e){
  e.preventDefault();  
  var t = $(this);
  var p = t.parents('form').trigger("submit");
})

$('.formSetRole').appLiveForm();
$(document).on("click",".close-flash",function (e){
  e.preventDefault();  
  var t = $(this);
  t.parents(".flash").remove();
})
$(document).on("click",".toggle-fullscreen",function (e){
		e.preventDefault();	
		var t = $(this);
		fullscreen("page");
		
	})
	/* Fonction Plein Ecran */
  function fullscreen(id) {
    var element = document.getElementById(id);
    if (element.mozRequestFullScreen)
      element.mozRequestFullScreen(element.ALLOW_KEYBOARD_INPUT);
    else if (element.webkitRequestFullScreen)
      element.webkitRequestFullScreen(element.ALLOW_KEYBOARD_INPUT);
  }



  $('.bt-popover, .step-popover').popover({html : true }); 
 
$.evalToggle = function (id){
  return $("#"+id+".bt-toggle").hasClass("toggle-on");
}

$(document).on("click",".bt-toggle",function (e){
  e.preventDefault();  
  var t = $(this);
  var id = t.attr("id");
  t.toggleClass("toggle-on");
  localStorage[id] = t.hasClass("toggle-on");
})
$(document).on("click","#quicksidebar-toggle",function (e){
  e.preventDefault();  
  var t = $(this);
  $('body').toggleClass("quicksidebar-active");
  
})



$(document).on("click",".bt-modal",function (e){
  e.preventDefault();  
  var t = $(this);
  $('#modal-title').html("crop");
  $('#modal-body').html("cropimg");
  $('#eventUrl').attr('href','dsqs');
  $('#myModal').modal();
  
})

});