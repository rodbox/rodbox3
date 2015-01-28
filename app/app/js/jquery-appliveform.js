(function($)
{

    $.fn.appLiveForm=function(options)
    {

        //On définit nos paramètres par défaut
      var defauts=
          {
            dataType          : "json",
            info              : true,
            infoStart         : true,
            event             : "click",
            infoUpd           : true,
            async             : true,
            before            : function (t){return true;},
            start             : function (t){
                // t.addClass("onLoad").attr({"disabled":true});
            },
            confirm           : function (){return true;},
            data              : {},
            form              : "",
            callback          : function (data,t){
                t.find("input").blur();
            },
            finish            : function(t){
              // t.removeClass("onLoad").removeAttr('disabled');
            }
          };

      var param=$.extend(defauts, options);

        $(document).on("submit",this.selector , function (){
          var t=$(this);
          param.start(t);
          var action        = t.attr("action");
          var dataSend      = t.serialize();
          var submit        = t.find("input[type=submit]");
          submit.loadOn();
          

          if(param.info){
            param.appInfo = $.appInfo.add({
                type  : "loader",
                title : this.selector,
                msg   : "En cours",
                open  : param.infoStart,
                timer : 0
            });
          }
          t.addClass('onLoad');
          param.before(t);
            $.post(action,dataSend,function (data){

                if(param.callback != null)
                  param.callback(data,t);

                if(param.info){
                  var appInfoParam = {
                      to  : data.infotype,
                      msg   : data.msg,
                      open  : true,
                      timer : (data.infotype=="error")?0:2500
                  };
                  if(data.infotype=="error"){
                    appInfoParam.msgmeta = data.msgmeta;
                  }
                  $.appInfo.upd(param.appInfo,appInfoParam);
                  submit.loadOff();
                  // t.removeClass('onLoad');
                }
            param.finish(t);

           },param.dataType);
          return false;
          })
        }

})(jQuery);