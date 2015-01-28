// required http://static.rodbox.fr/getselection/jquery-getselection.js
(function($){
    $.fn.appcaret=function(options){
      var t         = $(this.selector);
      var follower  = $(t.data("follower"));
      follower.addClass("appcaret-follower");
        //On définit nos paramètres par défaut
      var defauts =
           {
              top     : parseInt(t.css("line-height"))*2,
              left    : 0-follower.outerWidth()/2+60
           };

      var param=$.extend(defauts, options);

        $(document).on("keyup keypress click",this.selector , function (){
          var t        = $(this);
          var tracer   = $('<span>',{"id":"tracer"}).html("|");

          var val = t.val().substr(0,t.getSelectionCenter()).replace(/\n/g,"<br>");
          var val = val.replace(/\s/g,"&nbsp;");
          var val = val.replace(/\n/g,"<br>");
          var val = val.replace(/\t/g,"____");

          localStorage.selectStart  = t.getSelectionStart()
          localStorage.selectEnd    = t.getSelectionEnd()

          $('#hidecloner')
            .html(val)
            .append(tracer);

          var tracerPos = tracer.position();
          var tPos      = t.position();

          param.follower.css({
            top   : tracerPos.top   + tPos.top + param.top,
            left  : tracerPos.left  + param.left
          });

        })



      function init(selector){
        param.follower  = $($(selector).data("follower"));
        var output      = $("<div>",{id:"hidecloner"});
        $(selector).after(output);
      }

      $(document).on("click",".appcaret-follower .bt-close",function (){

        $('.appcaret-follower').removeClass("active");
      })

      init(this.selector);
    }
})(jQuery);


$(document).ready(function(){

    $.appfollow = {
        set : function (top,left){
            $(".appcaret-follower").css({
                top     : top,
                left    : left
            })
        },
        active:function(){
            $(".appcaret-follower").addClass("active");
        },
        hide:function(){
            $(".appcaret-follower").removeClass("active");
        }
    };



})
