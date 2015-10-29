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
            validate          : false,
            before            : function (t){return true;},
            start             : function (t){},
            confirm           : function (){return true;},
            data              : {},
            form              : "",
            callback          : function (data,t){
                t.find("input").blur();
            },
            success           : function (data,t){},
            error             : function (data,t){},
            finish            : function(t){
              // t.removeClass("onLoad").removeAttr('disabled');
            }
          };

      var param=$.extend(defauts, options);
      param.t = $(this);
        $(document).on("submit",this.selector , function (){
          var t=$(this);
          param.start(t);
          var action        = t.attr("action");
          var dataSend      = t.serialize();
          var submit        = t.find("input[type=submit]");


// if(param.validate){
//   if($.validateForm(this.selector)) {
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
                    validateMsg(data.validate,t);
                  }
                  $.appInfo.upd(param.appInfo,appInfoParam);
                  submit.loadOff();
                }
                else{
                  if(data.infotype == "error"){
                    param.appInfo = $.appInfo.add({
                        type  : "error",
                        title : this.selector,
                        msg   : data.msg,
                        open  : true,
                        timer : 0
                    });
                  }
                }

            if(data.infotype == "error")
              param.error(data,t);
            else if(data.infotype == "success")
              param.success(data,t);
            
            param.finish(t);

           },param.dataType);
//   }
// }


          return false;
          })
        }
        function validateMsg(validateList,t){
            t.addClass("form-error-validate");
            $.each(validateList, function(itemName, itemErrorList) {
              // var ul = $("<ul>");
               $("#item-"+itemName).addClass("form-item-alert");
               $.each(itemErrorList, function(indexItemError, valItemError) {
                  $("#item-"+itemName).find(".form-alert-item ul").append("<li>"+valItemError+"</li>")
               });
              var li = $("<li>").html('<label for="'+itemName+'">'+itemName+'</label>');
              t.find('#form-alert').find("ul").prepend(li);
          });
        }

        $(document).on("change","input",function (e){
          var t = $(this);
          t.parents(".form-item").removeClass("form-item-alert").find(".form-alert-item ul").html("");
        })
})(jQuery);