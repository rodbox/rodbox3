(function($)
{

    $.fn.appLiveExec=function(options)
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

        $(document).on(param.event,this.selector , function (){
          var t=$(this);
          param.start(t);
          var action        = t.attr("href");
          var dataSend      = (param.form!="")?$(param.form).serialize():{};

          

          if(param.info){
            param.appInfo = $.appInfo.add({
                type  : "loader",
                title : this.selector,
                msg   : "En cours",
                open  : param.infoStart,
                timer : 0
            });
          }
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
                }
            param.finish(t);

           },param.dataType);
          if(param.event=="click")
            return false;
          })
        }

})(jQuery);