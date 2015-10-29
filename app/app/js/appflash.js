$(document).ready(function($) {
	
  setTimeout(function (){
    $('.flash').addClass("outro");
    setTimeout(function (){
      $('.flash').remove();
    },1000)
  },3000);

  $.setFlash =  function (msg,type){
  	var type = (type == undefined)?"info":type;
  	var li = $("<li>",{"class":"flash flash-"+type})
  	var a = $("<a>",{"id":"id","class":"pull-right c-7 close-flash"}).html("x");
  	var p = $("<p>",{"id":"id","class":"class"}).html(msg);
  	li.append(a).append(p);
	  	$('ul.flash-container').append(li);
	  	setTimeout(function (){
	    li.addClass("outro");
	    setTimeout(function (){
	      li.remove();
	    },1000)
	  },3000);
  }

});