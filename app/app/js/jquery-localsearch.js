/*

option de recherche par l'attribut data-index du 
    <li data-index="ma valeur indexé">mon contenu</li>
localsearch scanera "ma valeur indexé" et pas "mon contenu"

en revanche si celui si n'est pas définit le filtre ce fait sur le contenu du <li> au format text 
    <li>mon contenu</li>
localsearch scanera "mon contenu"


jquery-navlist.js gere la navigation au clavier et à la sourie dans la liste.
*/

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
            scrollPrev  : 4,
 
            keyCodeList: [8, 13, 18, 27, 37, 38, 39, 40],
            onKeyUp     : function(t){},
            navList     : true
        };
        var param = $.extend(defauts, options);
        init($(this.selector));

        function init(t) {
            t.addClass("localsearch-listener");
            param.targetSelector = t.data("target");
            param.target = $(t.data("target"));
            param.target.addClass("localsearch");
            param.targetScroll = (!t.data("target-scroll"))?param.target:$(t.data("target-scroll"));

            param.targetLi = param.target.find("li");
            param.targetLi.addClass("search-show");

            param.liH = param.targetLi.outerHeight();

           if(param.navList)
                initNavList();
        }

        function initNavList(){
            // $(this.selector).navlist();
        }

        $(document).on("focus", this.selector, function(e) { createIndex();
            var listFirst = $("#file-list").find(".search-show").first();
            

        })
        $(document).on("focusout",this.selector,function (e){
            param.target.find(".onFocus").removeClass("onFocus");
        })
        $(document).on("keyup", this.selector, function(e) {
            var t = $(this);
            
            if(e.keyCode == "27" || e.keyCode == "13") {return false;}
            
            var find = param.find = t.val();
            scanIndex(find);
           
            param.onKeyUp(t);
           // sortBy();
        });

        $(document).on("keydown",this.selector,function (e){
            var t = $(this);
            if(e.keyCode == "13") {
               $(".onFocus").find("a.snippet-edit").trigger('click');
               return false;
            }
            else if(e.keyCode == "27"){
                t.val("").trigger("keyup");
                clearClass();
                return false;
            }
        })

        $(document).on("click",param.targetSelector + " li",function (e){
            var t = $(this);
  
            $("#localsearch").val(t.text());
             
            return false;
        })

        /* Créer un index plat (sans HTML) de la list a scanner */
        function createIndex() {
            param.index = new Array();
            $.each(param.targetLi, function(index, val) {
                var indexCur = $(val);
                if(indexCur.data("val")){
                    param.index.push(indexCur.data("val"));
                }
                else{
                    param.index.push(indexCur.text());
                }
            });
            param.targetLi.addClass("search-show");
            setLimit();
        }

        /* créer la regexp pour trouver le resultat */
        function createRegExp(strFind) {
            var strReg = "";
            var regexp = "[a-zA-Z0-9\\.\.\\s\_\-]{0,}";
            for (var i = 0; i < strFind.length; i++) strReg = strReg  + strFind[i] + "{1}(" + regexp + ")";
            param.findRegExp = strReg;
        }


        /* Ajoute la class first et last des elements visible */
        function setLimit(){
            var showList = param.target.find(".search-show");
            $(".search-first,.search-last").removeClass('search-first').removeClass('search-last');
            showList.first().addClass("search-first");
            showList.last().addClass("search-last");
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
            list.attr("data-count-child",0);
            if (find.length > 1) {
                list.removeClass("search-show").addClass("search-hide");
                list.removeClass("show-for-child");

                var i = 0;

                $.each(param.index, function(index, val) {
                    var elem = list.eq(index);
                    var patt = new RegExp(param.findRegExp, "i");
                    var eval = val.match(patt);
                    if (eval) {
                        note(elem,eval);
                        elem.attr("data-id",i++);
                        elem.addClass("search-show").removeClass("search-hide");
                        /* attribut un point au parent pour signaler qu'il est affichable */
                        toParent(elem);

                    }
                    else{
                        /* On attribut la note */
                        var noteHide = 999;
                        elem.attr("data-note", noteHide);
                       
                        /* On attribut la valeur de reference pour le sort*/
                        if(elem.data("val")){
                            elem.attr("data-sort", noteHide+"_"+elem.data("val"));
                        }
                        else{
                            elem.attr("data-sort", noteHide+"_"+elem.text());
                        }
                    }

                });
            } 
            else {
                list.removeClass("search-hide").addClass("search-show").attr("data-note", 0);
                clearClass();
            }
            
            setLimit();
            // sortBy()

        }
        /* Fonction qui attribut les points si le child est affichable */
        function toParent(elem){
            var pLi  = elem.parents("li");
            $.each(pLi, function(index, val) {
                 var parent = $(val);
                 var valCount = parseInt(parent.attr("data-count-child"));
                 parent.attr("data-count-child",valCount++);
                 parent.addClass("show-for-child");
            });
            var pUl  = elem.parents("ul");
            $.each(pUl, function(index, val) {
                 var parent = $(val);
                 parent.addClass("open-for-search");
            });
        }
        function clearClass(){
            $(".open-for-search").removeClass("open-for-search");
            $(".show-for-child").removeClass("show-for-child");
            $(".search-hide").removeClass("show-for-child");
        }
    }
})(jQuery);