$(document).ready(function(){

$.appInfo.init();

/* Gestion des routes avec Jquery */
$.routeExec = function (route,q){
  return "http://192.168.1.15/rodbox3/app/app-exec.php?route="+route;
}
$.routePage = function (route,q){
  return "http://192.168.1.15/rodbox3/web/?route="+route;
}
$.routeView = function (){
  return "http://192.168.1.15/rodbox3/app/app-view.php";
}
$.redirectRoutePage = function (route,q){
  var url = $.routePage(route);
    var q = "&"+$.param(q);

   $.redirect(url+q);
}

/* END Gestion des routes avec Jquery */
$.redirect = function(url) {
    localStorage.current = url;
    window.location.href = url;
};
/* FullMsg */
$.fullmsg = {
    intro : function(msg,options){
      var defauts=
            {
              delay : 2000,
              outroDelay : 1300,
              callback:function(t){}
            };
    var param=$.extend(defauts, options);
    var msgContainer = $("<div>",{"id":"fullmsg","class":"fullmsg-container"});
    var p = $("<p>").html(msg);

    msgContainer.append(p);
    $('body').prepend(msgContainer);
    setTimeout(function(){
      msgContainer.addClass("open");
    },100);

    setTimeout(function(){
      msgContainer.find("p").addClass("outro");
          setTimeout(function(){
            param.callback(msgContainer);
          },param.delay*0.8)
    },param.delay)


  },
  outro : function (){
    msgContainer = $("#fullmsg");
     setTimeout(function(){
      msgContainer.removeClass("open");
        setTimeout(function(){
          msgContainer.remove();  
        },750);
    },100);
  }
};

$.fullmsg.outro();
/* END FullMsg */

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

  $('#formLogin').appLiveForm({
    info:false,
    callback:function (json,t){
    $.fullmsg.intro(json.data.msg,{callback:function (){


      $.redirectRoutePage(json.data.route,{"intro":true});
    }});
  }});

  
  // $('.user-disconnect').appLiveExec({
  //   info:false,
  //   callback:function (json,t){
  //   $.fullmsg("Bonne journée",{callback:function (){
  //     $.redirectRoutePage(json.data.route);
  //   }});
  // }});

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

  $('.bt-popover').popover();

});