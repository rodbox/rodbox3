(function($){
    $.fn.lockOn=function(){
      $(this).attr("disabled","disabled").addClass("onLock");
    }
    $.fn.lockOff=function(){
      $(this).removeAttr("disabled").removeClass("onLock");
    }
    $.fn.loadOn=function(){
      var t = $(this);
      t.attr("data-html",t.html());
      t.addClass("onLoad").lockOn();
      t.html("En chargement");
    }
    $.fn.loadOff=function(){
      var t = $(this);
      t.removeClass("onLoad").lockOff();
      t.html(t.data("html"));
    }
})(jQuery);