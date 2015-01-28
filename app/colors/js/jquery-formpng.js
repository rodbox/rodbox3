(function($){
    $.fn.formpng=function(options){

    //On définit nos paramètres par défaut
    var defauts = {
      marg    : 10,
      byLine  : 5,
      pW      : 40,
      pH      : 25,
      pTxtH   : 25,
      font1   : "15px Verdana",
      font2   : "9px Verdana",
      colorTxt: "#888",
      colorBg : "#000",
      footerTxt : "http://demo.rodbox.fr/colors",
      canvasID : "myCanvas",
      url     : 'palettes/palette-default.json'
    };

    var param=$.extend(defauts, options);

    var t = $(this);
    var title = t.find("[name=title]").val();
    var date  = t.find(".date").val();
    var colorList = t.find(".color-hex");

    var marg   = param.marg;
    var byLine = param.byLine;
    var pW     = param.pW;
    var pH     = param.pH;
    var pTxtH  = param.pTxtH;
    var footerTxt = param.footerTxt;

    var font1 = param.font1;
    var font2 = param.font2;
    var colorTxt = param.colorTxt;



    var canvas = $("<canvas>", {
        "id": param.canvasID
    }).hide();

    $('body').append(canvas);
    var c = document.getElementById(param.canvasID);
    var ctx = c.getContext("2d");

    /* Definition des variables calculées */
    var outerHeight = pH + pTxtH;
    var nbLine      = Math.ceil(colorList.length / byLine);
    
    var w           = (marg * 2) + pW * byLine;
    var h           = (marg * 1.5) + ((nbLine + 1) * (pH + pTxtH));

    /* Canvas resize */
    $('canvas#'+param.canvasID).attr({
        "width" : w + "px",
        "height": h + "px"
    });

    /* BG color */
    ctx.fillStyle = param.colorBg;
    ctx.fillRect(0, 0, w, h);

    /* Title */
    ctx.font        = font1;
    ctx.fillStyle   = colorTxt;
    ctx.fillText(title, marg, marg * 2.3);
    var textWidth   = ctx.measureText(title).width;

    /* Date */
    ctx.font        = font2;
    ctx.fillText(date, textWidth + marg * 1.5, marg * 2.3);
    var curLine     = 0.6; //index de ligne
    var cur         = 0; //index de position dans la ligne

        /* Each color */
        $.each(colorList, function(index, val) {

            /* coordonnée de p */
            var x       = marg + (cur * pW);
            var y       = marg + (curLine * outerHeight);

            /* Preview color */
            ctx.fillStyle = $(val).val();
            ctx.fillRect(x, y, pW, pH);

            /* Index color */
            var text    = index + 1;
            ctx.fillStyle = colorTxt;
            ctx.fillText(text, x + 5, y + pH + pTxtH / 2);

            /* Compteur de position */
            cur++;
            if (cur >= byLine) {
                cur     = 0;
                curLine++;
            }
        });
        /* End Each color */

        /* Footer */
        ctx.fillStyle = colorTxt;
        ctx.fillText(footerTxt, marg, h - pTxtH / 2);
        /* End Footer */


        var canvasData  = c.toDataURL("image/png");
        var img = $("<img>", {
            "src"   : canvasData
        })

        var r = {
            img : img,
            imgData : canvasData
        }
        return r;




    }
})(jQuery);