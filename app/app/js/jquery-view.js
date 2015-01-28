
(function($) {
    $.fn.appView = function (app,view,data,options){
        //On définit nos paramètres par défaut
       //On définit nos paramètres par défaut
      
      /* Paramètres de la vue */
      var dataDefauts={};
      var dataSend=$.extend(dataDefauts, data);
      /* END Paramètres de la vue */


      /* Paramètres du plugin */
      var paramDefault = {
          t         : $(this),
          callback  : function(html,t){
            t.append(html);
          }
      }
      var param=$.extend(paramDefault, options);
      /* END Paramètres du plugin */

     var data = {
        "app":app,
        "view":view,
        "d":dataSend
      };
      var url = $.routeView();
    $.post(url,data, function (html,t){
        param.callback(html,param.t);
      });


    }
})(jQuery);