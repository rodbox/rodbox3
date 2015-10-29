(function($){
    $.fn.appkeynav=function(options){

        //On définit nos paramètres par défaut
    	var defauts={

        };

    	var param=$.extend(defauts, options);

    	function init(){
    		param.target = $($(this.selector).data("target-search"));
            param.list = $(param.target);
    	}
    	init();



    	$(document).on("keydown",function (e){
    		var k = e.keyCode;
    		
    		if(k==40){
    			return keynav(+1);
    		}
    		else if (k==38){
    			return keynav(-1);
    		}
    		else if (k==13 && $.evalAlt("onAlt")){
    			execSelect();
    			return false;
    		}
    		
    	})

    	function keynav(sens){
    		param.list = param.target.find(".search-show");
    		param.first = param.list.first().addClass("search-first");
    		param.last = param.list.last().addClass("search-last");

            var cur = $(".onSelect");

    		var next = (cur.hasClass("search-last"))?cur:cur.nextAll(".search-show").first();
    		var prev = (cur.hasClass("search-first"))?cur:cur.prevAll(".search-show").first();
            $(".onSelect").removeClass('onSelect');

    		if(sens>0){
    			next.addClass('onSelect');
    		}
	    	else{
                prev.addClass('onSelect');
            }
                scrollTo();
                return true;
    	}

    	function execSelect(){
    		$(".onOpen").removeClass('onOpen');
    		$(".onSelect").addClass("onOpen").find('a').first().trigger('click');
    	}


        function scrollTo(){
            var pos = $(".onSelect").position();
            var h  = $('#snippet-list-col').height();
            var st = $('#snippet-list-col').scrollTop();
            if(pos.top>h){
                var to = (h/2)+pos.top;
                $('#snippet-list-col').stop().animate({
                    "scrollTop":to
                })
            }
 
        }

}})(jQuery);
