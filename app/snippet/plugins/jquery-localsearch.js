(function($) {
    $.fn.localsearch = function(options) {
        //On définit nos paramètres par défaut
        var defauts = {

            target: "",
            index: "",
            find: "",
            findRegExp: "",
            findList: [],
            findListPoint: 0,
            scrollPrev  : 10,
            autoScroll: true,
            keyCodeList: [8, 13, 18, 27, 37, 38, 39, 40]
        };
        var param = $.extend(defauts, options);
        init($(this.selector));

        function init(t) {

            param.targetSelector = t.data("target");
            param.target = $(t.data("target"));
            param.target.addClass("localsearch");
            param.targetScroll = (!t.data("target-scroll"))?param.target:$(t.data("target-scroll"));
            console.log(t.data("target-scroll"));
            param.targetLi = param.target.find("li").not("#liModel");
            param.targetLi.addClass("search-show");

            param.liH = param.targetLi.outerHeight();

        }

        $(document).on("focus", this.selector, function(e) { createIndex();
            autoFocus("");
        })
        $(document).on("focusout",this.selector,function (e){
            param.target.find(".onFocus").removeClass("onFocus");
        })
        $(document).on("keyup", this.selector, function(e) {
            var t = $(this);
            
            if(e.keyCode == "38"|| e.keyCode == "40" || e.keyCode == "27" || e.keyCode == "13" || e.keyCode == "18") {return false;}
            
            var find = param.find = t.val();
           scanIndex(find);
           autoFocus("");

           // sortBy();
        });

        $(document).on("keydown",this.selector,function (e){
            var t = $(this);
            if(e.keyCode == "38") {autoFocus(-1); return false;}
            else if(e.keyCode == "40") {autoFocus(1); return false;}
            else if(e.keyCode == "13") {
               $(".onFocus").find("a.snippet-edit").trigger('click');
               return false;
            }
            else if(e.keyCode == "27"){
                t.val("").trigger("keyup");
                return false;
            }
            else if (e.keyCode=="18") {
                var liOnFocus = $(".onFocus");
             checkbox = liOnFocus.find("input[type=checkbox]");
                var isChecked = checkbox.is(':checked');
                if(isChecked)
                    checkbox.prop('checked',false);
                else
                    checkbox.prop('checked', true);
                liOnFocus.toggleClass('onChecked');
             };
        })

        $(document).on("click",param.targetSelector + " li",function (e){
            var t = $(this);
            $('.onFocus').removeClass('onFocus');
            t.addClass("onFocus");
            $("#localsearch").val(t.text());
             autoScroll();
            return false;
        })

        /* Créer un index plat (sans HTML) de la list a scanner */
        function createIndex() {
            param.index = new Array();
            $.each(param.targetLi, function(index, val) {
                var indexCur = $(val);
                param.index.push(indexCur.text());
            });
            param.targetLi.addClass("search-show");
            setLimit();
        }

        /* créer la regexp pour trouver le resultat */
        function createRegExp(strFind) {
            var strReg = "";
            var regexp = "[a-zA-Z0-9\\.\\s\_\-]{0,}";
            for (var i = 0; i < strFind.length; i++) strReg = strReg  + strFind[i] + "{1}(" + regexp + ")";
            param.findRegExp = strReg;
        }

        /* Gere la navigation du focus  dans la liste */
        function autoFocus(sens){
            var elemFocus = param.target.find(".onFocus");
            if(sens == "")
                elemFocus = param.target.find(".search-show").first();
            else if(sens > 0 && navLimit(sens))
                elemFocus = elemFocus.nextAll(".search-show").first();
            else if (sens < 0 && navLimit(sens))
                elemFocus = elemFocus.prevAll(".search-show").first();

            if (elemFocus=="") {
               elemFocus = param.target.find(".search-show").first(); 
            };


            param.target.find(".onFocus").removeClass('onFocus');
            elemFocus.addClass("onFocus");

            if(param.autoScroll)
                autoScroll();
        }

        /* Ajoute la class first et last des elements visible */
        function setLimit(){
            var showList = param.target.find(".search-show");
            $(".search-first,.search-last").removeClass('search-first').removeClass('search-last');
            showList.first().addClass("search-first");
            showList.last().addClass("search-last");
        }

        function autoScroll(){
            var elemFocus = param.target.find(".onFocus");

            var top = parseInt(elemFocus.index(".search-show")-param.scrollPrev)*param.liH;
  
            param.targetScroll.stop().animate({scrollTop:top},125);
        }

        function navLimit(sens){
            var elemFocus = param.target.find(".onFocus");
            
            var hasFirst = elemFocus.hasClass("search-first");
            var hasLast = elemFocus.hasClass("search-last");

            if(sens > 0 && hasLast)
                return false;
            else if (sens < 0 && hasFirst)
                return false;
            else
                return true;
        }


        function sortBy(){

            var listLi = param.targetLi.detach();

            listLi.sort(function(a,b){
                var an = a.getAttribute('data-sort');
                var bn = b.getAttribute('data-sort');
                if(an > bn) {
                    return 1;
                }
                if(an < bn) {
                    return -1;
                }

                return 0;
            });

          listLi.appendTo(param.target);
            
            // createIndex();
        }

        /*
          La note de pertinance de resultat :

          la sanction de point ne ce fait qu'entre les caractères saisie et non sur la totalité de la chaine de l'element

          +1 si le premier caractère saisie n'est pas égal a celui de l'element.
          +1 pour chaque caractère de l'element non saisie
        */

        function note(elem,matchArray) {
            var search = elem.text();
            var note = 0;

            /* On rajoute 1pt de pénalité si le premier caractère dela recherche n'est pas identique au premier de l'element */
            if (param.find[0] != search[0]) note = note + 1;

            /* Incrementation de la note de pertinance*/
            note = note + posNote(matchArray);

            /* On attribut la note */
            elem.attr("data-note", note);
            /* On attribut la valeur de reference pour le sort*/
            elem.attr("data-sort", note+"_"+search);
        }

        /* On rajoute 1pt pour chaque caractère trouvé entre deux caractères saisies */
        function posNote(matchArray) {
            var notePos = 0;
            if(matchArray.length > 0){
                // on retire le premier element match c'est la chaine trouvé
                matchArray.shift();
                // on retire le dernier il comporte tout les caractères suivant trouvé non saisie et il ne sont pas pris en compte dans le barème
                matchArray.pop();
                $.each(matchArray, function(index, val) {
                    notePos = notePos + val.length;
                });
            }
            return notePos;
        }

        /* parcour l'index et renvois tout les index trouvé a la param.findRegExp */
        function scanIndex(find) {
            createRegExp(find);
            var list = param.target.find("li");
            if (find.length > 1) {
                list.removeClass("search-show").addClass("search-hide");
                var i = 0;
                $.each(param.index, function(index, val) {
                    var elem = list.eq(index);
                    var patt = new RegExp(param.findRegExp, "i");
                    var eval = val.match(patt);
                    if (eval) {
                        note(elem,eval);
                        elem.attr("data-id",i++);
                        elem.addClass("search-show").removeClass("search-hide");
                    }
                    else{
                        /* On attribut la note */
                        var noteHide = 999;
                        elem.attr("data-note", noteHide);
                        /* On attribut la valeur de reference pour le sort*/
                        elem.attr("data-sort", noteHide+"_"+elem.text());
                    }
                });
            } 
            else {
                list.removeClass("search-hide").addClass("search-show").attr("data-note", 0);
            }

            setLimit();
            // sortBy()
            autoFocus();
        }
    }
})(jQuery);