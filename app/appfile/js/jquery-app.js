/*

requiered = jquery-localsearch.js
requiered = jquery-appliveform.js
requiered = jquery-appinfo.js

 */

(function($){
    $.fn.appfile=function(options){

        //On définit nos paramètres par défaut
      var defauts=
           {
              localsearch : true,
              autoopen : true,
              refresh : true
            };

      var param=$.extend(defauts, options);

      var t = $(this.selector);
      init();

      function init(){
        param.url = t.attr("href");

        var url = t.attr("href");

        $.post(url, function(data) {
          /* Si il y a une erreur */
          if(data.infotype == "error"){
                    param.appInfo = $.appInfo.add({
                        type  : "error",
                        title : this.selector,
                        msg   : data.msg,
                        open  : true,
                        msgmeta:data.msgmeta,
                        timer : 0
                    });
                  }
          param.list = listMaker(data.data.filelist,"");
          if(t.data("auto-open"))
            param.autoOpenFile = t.data("auto-open");
          else
            param.autoopen= false;

          t.replaceWith(param.list);

          /*** FOLDER MENU **/
          /* http://blog.rodbox.fr/rodbox-appview-charger-une-view/ */
          $('#app-sidebar').appView("appfile","folder-menu",{},{
            callback:function(json,t){
              t.append(json);
              $(".file-create").appLiveForm({
                callback : function (json,t){
                  $("a.fileservice").nextAll("ul.file-list").first().append(json.data);
                }
              });
            }
          });
          /*** END FOLDER MENU **/

          

          if(param.localsearch)
            localsearchInit();

          /**  Si le mode autoopen est activé et que le bouton contient un liens vers un fichier de la liste celui est ouvert automatiquement **/
          if(param.autoopen){
            var autoOpenFile = param.autoOpenFile.split(/(\\|\/)/g).pop(); // on récupère le nom du fichier;
            $(".localsearch-listener").attr("value",autoOpenFile);
            $(".localsearch-listener").trigger('keyup');

            param.list.find('a[data-location$="'+autoOpenFile+'"]').trigger("click");
          }



          
        
        },'json');
        
      }


      function refresh(){
        $(".bt-filerefresh").addClass('spin');
        $.post(param.url, function(data) {
          

          $("#file-list").replaceWith(listMaker(data.data.filelist,"",true));


          $(".bt-filerefresh").removeClass('spin');
        },"JSON");
    }
      function listMaker(data,suffix){
        var ul = $("<ul>",{"class":"file-list"}).attr("data-location",suffix);
        if (suffix=="")
          ul.addClass("root").attr("id","file-list");

          $.each(data, function(index, val) {
            var li = $("<li>");
            var a = $("<a>",{href:"#"});
            if($.type(val)=="string"){
              var suffixLi = suffix+"/"+val;
              a
              .attr("data-location",suffixLi)
              .addClass("file-link")
              .attr("href",suffixLi)
              .html(val);

              li
              .attr("data-index",suffixLi)
              .attr("data-val",val)
              .attr("data-dir",suffix)
              .attr("data-type","file")
              .html(a);
            }
            else{
              var suffixLi = suffix+"/"+index;
              a.html(index)
              .attr("data-location",suffixLi)
              .addClass("folder-link");
              li
              .attr("data-index",suffixLi)
              .attr("data-val",index)
              .attr("data-dir",suffix)
              .attr("data-type","folder")
              .html(a).addClass("folder");
              
              var subUl = listMaker(val,suffixLi);
              li.append(subUl);
            }
            ul.append(li);
          });
        return(ul);
    }



    function localsearchInit(){
      // var url = "../localsearch/plugins/jquery-localsearch.js";
      // $.getScript(url,function(){
        inputID = "localsearch-"+param.id;

        var inputGroup = $("<div>",{"class":"input-group input-group-localsearch"});
        var inputAddon = $("<span>",{"class":"input-group-addon"});
        var inputISearch = $("<i>",{"class":"glyphicon glyphicon-search"});

        var inputIRefresh = $("<i>",{"class":"glyphicon glyphicon-refresh"});

        var input = $("<input>",{
          "id":inputID,
          "class":"form-control",
          "type":"text",
          "data-target":"#file-list"
        })
        var spanMeta = $("<span>",{"id":"localsearch-"+param.id+"-meta","class":"localsearch-meta small block"}).html(" ");
        
        /*** REFRESH BT ***/
          var btRefresh = $("<a>",{"href":"#","class":"bt-filerefresh pad-3 pull-right"}).html(inputIRefresh).click(function(){
            refresh();
          });
          /*** END REFRESH BT ***/


        inputAddon.append(inputISearch);
        inputGroup
        .append(inputAddon)
        .append(input)
        
        


        $("#file-list").before(inputGroup);
        inputGroup.after(spanMeta).after(btRefresh);
        $("#"+inputID).localsearch({
          onKeyUp:function (t){
            $(".open-for-search").removeClass("open-for-search");
            $('.search-show').parents("ul").addClass("open-for-search");
            var find = $('.search-show').length;
            var total = $('.localsearch').find("li").length;
            $('.localsearch-meta').html(find+"/"+total);
          }
        });

      // });
      
    }





/* FOLDER LINK */
    $(document).on("click",".folder-link",function (e){
      e.preventDefault();  
      var t = $(this);
      hideFolderMenu();
      t.toggleClass("open").next(".file-list").toggleClass("open");
      return false;
    })

      $(document).on("mousedown",".folder-link",function (e){
    if (e.button == 2) {
          var t = $(this);
          toggleFolderMenu(t);
            $(document)[0].oncontextmenu = function() {
                return false;
            }
            return false;
        }
    })

    function toggleFolderMenu(t){
      if(!t.hasClass("fileservice")){
        var location = t.attr("data-location");
        var pos = t.offset();
        // $(".foldermenu-clone").remove();
        $('.fileservice').removeClass('fileservice');
        t.addClass("fileservice");
        $('.appfile-foldermenu').show().css({
          top   : pos.top+t.outerHeight(),
          left  : pos.left,
          width : t.width()
        }).find("form").attr("data-location",location).find("#location").val(location);
        
        // 
        // 
        // var clone = $('.appfile-foldermenu').clone().addClass('foldermenu-clone').show();
        // var li = $("<li>",{'class':'folermenu'}).append(clone);
        // t.addClass("open");
        // t.next("ul").addClass("open").prepend(li);
        // li.find(".autofocus").focus();
      }
      else{
        hideFolderMenu();
      }
      $(".autofocus").focus();
    }
    function hideFolderMenu(){
      $(".foldermenu-clone").remove();
      $('.fileservice').removeClass('open').removeClass('fileservice');
      $('.appfile-foldermenu').hide();
    }
/* END FOLDER LINK */







    }
})(jQuery);