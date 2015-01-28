(function($){
    $.fn.[JQUERY_PLUGIN_NAME]=function(options){

        //On définit nos paramètres par défaut
      var defauts=
           {
              param1    : "",
              param2    : ""
           };

      var param=$.extend(defauts, options);

        $(document).on([EVENT],this.selector , function (){
          var t=$(this);

          return false;
        })
    }
})(jQuery);