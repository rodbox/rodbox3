(function($){
    $.fn.appaltkey=function(){

      var keyList = {
        16  : "onMaj",
        17  : "onCtrl",
        18  : "onAlt",        
        20  : "onMajlock",
        9   : "onTab",
        27  : "onEsc",
        32  : "onSpc",
        224 : "onCmd"
      }

      var keyEval = [16,17,18,20,9,27,32,224];
      $(document).keydown(function (event){
        var keyCode = event.keyCode;
        if($.inArray(keyCode,keyEval)>=0)
          $('body').data(keyList[keyCode],true);
      }).keyup(function (event){
        var keyCode = event.keyCode;
        if($.inArray(keyCode,keyEval)>=0)
          $('body').data(keyList[keyCode],false);
      })
    }
})(jQuery);

$.evalAlt = function (keyEval){
  return $('body').data(keyEval);
}