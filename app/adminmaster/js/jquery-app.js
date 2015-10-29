(function($) {
// calcule le pourcentage d'accomplissement par rapport au contenue d'une liste d'input par rapport a leur valeur.
// ex: 
// <input class="counter_eval" value="content 1">
// <input class="counter_eval" value="content 2">
// <input class="counter_eval" value="">
// <input class="counter_eval" value="content 4">

// .counter_eval = 75%;
// 3 / 4 champs sont remplis

$.fn.counterProgress = function() {

  if (!this.length) { return this; }



  this.each(function() {
    var t = $(this);
    var targetSelector = t.data("target");
    var count = 0;
    targetList = $(targetSelector);
    var length = targetList.length;
    $.each(targetList, function(index, val) {
    	var value = $(val).val();
    	count = (value=="")?count+0:count+1;
    });
    var progress = Math.round((count/length)*100);
    if(!isNaN(progress)){
      t.html(progress+"%");
      if (progress==100){
        t.removeClass(t.attr("data-class")).addClass("progress-complete").attr("data-class","progress-complete");
      }
      else if(progress > 50){
        t.removeClass(t.attr("data-class")).addClass("progress-50").attr("data-class","progress-50");
      }
      else if(progress > 0){
        t.removeClass(t.attr("data-class")).addClass("progress-1").attr("data-class","progress-1");
      }
      else{
        t.removeClass(t.attr("data-class")).addClass("progress-0").attr("data-class","progress-0");
      }
    }
      console.log(count);
      


    
  });




  return this;
};



})(jQuery);
