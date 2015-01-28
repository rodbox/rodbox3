$(document).ready(function() {
    function rgbToHex(rgb) {
        var r = rgb.split(",");
        return "#" + toHex(r[0]) + toHex(r[1]) + toHex(r[2]);
    }

    function toHex(n) {
        n = parseInt(n, 10);
        if (isNaN(n)) return "00";
        n = Math.max(0, Math.min(n, 255));
        return "0123456789ABCDEF".charAt((n - n % 16) / 16) + "0123456789ABCDEF".charAt(n % 16);
    }

    function cutHex(h) {
        return (h.charAt(0) == "#") ? h.substring(1, 7) : h
    }

    function hexToRgb(colorHex, str) {
        var str = (str == "") ? false : str;
        var R = parseInt((cutHex(colorHex)).substring(0, 2), 16)
        var G = parseInt((cutHex(colorHex)).substring(2, 4), 16)
        var B = parseInt((cutHex(colorHex)).substring(4, 6), 16)
        if (str == true) {
            return R + "," + G + "," + B;
        } else {
            return {
                "R": R,
                "G": G,
                "B": B
            }
        }
    }
    $(document).on("keyup", "input.color-preview", function() {
        var t = $(this);
        t.css("background-color", t.val());
    })
    $(document).on("click", "button.add-color", function(e) {
        console.log(p);
        var colorDefault = "#ffffff";
        var t = $(this);
        var p = t.parents("form").find("ul.color-list");
        var preview = $("<div>", {
            "class": "color-preview color-preview-thumb"
        }).css("background-color", colorDefault);
        var input = $("<input>", {
            "class": "color-hex",
            "type": "hidden",
            "name": "color-value[]"
        }).val(colorDefault);
        var inputName = $("<input>", {
            "type": "hidden",
            "name": "color-name[]"
        }).val("color-" + p.find('li').length);
        var span = $("<span>", {
            "class": "color-ref block"
        }).html(p.find("li").length + ".");
        var li = $("<li>").append(span).append(preview).append(input).append(inputName);
        p.append(li);
        return false;
    })

    // $("form.css-color").appLiveForm();
    // $(".export-css-color").on("click", function() {
    //     var t = $(this);
    //     var data = t.parents("form").serialize();
    //     var href = t.attr("href");
    //     var appInfoParam = {
    //         type: "app-loader",
    //         title: "Export",
    //         msg: "En cours",
    //         delay: 500
    //         };
    //     // var appInfo = $.appInfo.add(appInfoParam);
    //     $.post(href, data, function(data) {
    //         var appInfoParam = {
    //             type: "app-" + data.infotype,
    //             msg: data.msg,
    //             delay: 2500
    //         };
    //         // $.appInfo.upd(appInfo, appInfoParam);
    //         var resultZone = t.parents("form").find(".result");
    //         var linkCss = $('<a>', {
    //             href: data.app.file,
    //             "class": "c-2"
    //         }).html("color.css");
    //         var linkMinCss = $('<a>', {
    //             href: data.app.filemin,
    //             "class": "c-2"
    //         }).html("color.min.css");
    //         resultZone.html("");
    //         resultZone.append(linkMinCss);
    //         resultZone.append(" ");
    //         resultZone.append(linkCss);
    //         resultZone.append("<hr>");
    //         resultZone.append("<pre>" + data.app.css + "</pre>");
    //     }, "json");
    //     return false;
    // })
    $("#new-palette").on("click", function(e) {
    	var paletteList = $('#palette-list');
    	var clone = paletteList.find("li").first().clone();
    	clone.addClass("new-palette");
    	clone.find("input").val("");
    	clone.find(".color-list").html("").sortable({
                refreshPositions: true
            });

    	paletteList.prepend(clone);
        // var t = $(this);
        // var data = {
        //     title: 'new-palette',
        //     'palette': ["#000", "#fff"],
        //     'class': 'new-palette'
        // };
        // var href = t.attr("href");
        // $.post(href, data, function(data) {
        //     $("#side-wrapp").scrollTop(0);
        //     var data = $.parseHTML(data);

        //     $('#palette-list').prepend(data).find('ul.color-list').sortable({
        //         refreshPositions: true
        //     });
        // });
    })
    $(document).on("keyup change", "input[name=color-name]", function() {
        var t = $(this);
        var p = t.parents("li");
        p.find('input[name="color-name[]"]').val(t.val());
    })
    $(document).on("keyup change", "input.color-rgb", function() {
        var t = $(this);
        var p = t.parents("li.toggle-on");
        var R = p.find("input[name=color-r]").val()
        var G = p.find("input[name=color-g]").val()
        var B = p.find("input[name=color-b]").val()
        var hex = rgbToHex(R + "," + G + "," + B);
        p.find(".color-hex").val(hex);
        p.find(".color-preview").css("background-color", hex);
        $("#picker").spectrum("set", hex);
    })
    $(document).on("keyup change", "input.color-hex", function() {
        var t = $(this);
        var p = t.parents("li.toggle-on");
        var hex = t.val();
        var rgb = hexToRgb(hex, false);
        var R = p.find("input.color-r").val(rgb.R);
        var G = p.find("input.color-g").val(rgb.G);
        var B = p.find("input.color-b").val(rgb.B);
        p.find(".color-hex").val(hex);
        p.find(".color-preview").css("background-color", hex);
        $("#picker").spectrum("set", hex);
        // $('#picker').spectrum({color:hex});
    })
    $(document).on("click", ".color-list li:not(.toggle-on)", function(e) {
        var t = $(this);
        $('#color-edit').remove();
        $('.color-list .toggle-on').removeClass("toggle-on");
        t.addClass('toggle-on');
        var colorHex = t.find('input[name="color-value[]"]').val();
        var colorName = t.find('input[name="color-name[]"]').val();
        var colorRGB = hexToRgb(colorHex, false);
        var initial = $("<input>", {
            "type": "text",
            "id": "color-initial",
            "class": "color-initial"
        }).css({
            "background-color": colorHex + "!important",
            "color": colorHex
        }).val(colorHex).click(function() {
            var t = $(this);
            var p = t.parents("li.toggle-on");
            var hex = t.val();
            $("#picker").spectrum("set", hex);
            p.find(".color-preview").css("background-color", hex);
            var rgb = hexToRgb(hex, false);
            console.log(rgb);
            var R = p.find("input.color-r").val(rgb.R);
            var G = p.find("input.color-g").val(rgb.G);
            var B = p.find("input.color-b").val(rgb.B);
        });
        var picker = $("<input>", {
            "id": "picker",
            "type": "text"
        })
        var preview = $("<div>", {
            "class": "color-preview"
        }).css("background-color", colorHex).click(function() {
            $('#color-edit').remove();
            t.removeClass("toggle-on");
        });
        var containForm = $("<div>", {
            "class": "pad-4"
        });
        var labelInputName = $("<label>", {
            "for": "color-name",
            "class": "c-6 small block"
        }).html("Name");
        var inputName = $("<input>", {
            "type": "text",
            "name": "color-name"
        }).val(colorName);
        var labelInputRGB = $("<label>", {
            "name": "color-rgb",
            "class": "c-6 small block"
        }).html("RGB");
        var inputRGB_R = $("<input>", {
            "type": "text",
            "name": "color-r",
            "class": "w-33 inline color-rgb color-r"
        }).val(colorRGB.R);
        var inputRGB_G = $("<input>", {
            "type": "text",
            "name": "color-g",
            "class": "w-33 inline color-rgb color-g"
        }).val(colorRGB.G);
        var inputRGB_B = $("<input>", {
            "type": "text",
            "name": "color-b",
            "class": "w-33 inline color-rgb color-b"
        }).val(colorRGB.B);
        var inputHEX = $("<input>", {
            "type": "text",
            "name": "color-hex-edit",
            "class": "color-hex"
        }).val(colorHex);
        var aDel = $("<a>", {
            "href": "#",
            "class": "f-right t-right small no-decoration padding-bottom-5 margin-top-15 margin-right-10"
        }).html("supprimer").click(function() {
            t.remove()
        });
        var container = $("<div>", {
            "id": "color-edit",
            "class": "box"
        })
        containForm.append(initial).append(inputHEX).append(labelInputRGB).append(inputRGB_R).append(inputRGB_G).append(inputRGB_B).append(labelInputName).append(inputName).append(aDel)
        container.append(preview).append(picker).append(containForm);
        t.prepend(container);
        $('#picker').spectrum({
            flat: true,
            showInput: true,
            showButtons: false,
            color: colorHex,
            move: function(color) {
                var c = color.toHexString(); // #ff0000
                t.find(".color-hex").val(c).trigger('keyup');
            }
        });
    })
    $('ul.color-list').sortable({
        refreshPositions: true
    });
    $(document).on("keypress", function(e) {
        if (e.keyCode == 39) $(".color-list li.toggle-on").next().trigger("click");
        else if (e.keyCode == 37) $(".color-list li.toggle-on").prev().trigger("click");
        else if (e.keyCode == 40) $(".color-list li.toggle-on").parents("form").next().find(".color-list li").first().trigger("click");
        else if (e.keyCode == 38) $(".color-list li.toggle-on").parents("form").prev().find(".color-list li").first().trigger("click");
    })


function result(t,json){
    var h = t.outerHeight();
    var w = t.outerWidth();
    var modalBg = $("<div>",{"class":"modal-bg"}).html(" ");
    $('body').addClass("modal-on").prepend(modalBg);
    $("#form-result").remove();

    var btClose = $("<a>",{"href":"#","class":"close c-7 marg-right-4 marg-top-3"}).html('<i class="glyphicon glyphicon-remove"></i>').click(function(){
        $('body').removeClass("modal-on");
        modalBg.remove();
        $("#form-result").remove();
        return false;
    });
    var r = $("<div>",{"id":"form-result","class":"css-color-result absolute z-max animate "+json.infotype});
    
    r.css({
        "min-height" : h,
        width : w,
        'margin-top': (0-(h+15))+"px"
    }).html(json.data);
    r.prepend(btClose);
    t.parents("li").append(modalBg).append(r);
}

     $(document).on("submit","form.css-color",function(){
        var t = $(this);
        var action = t.attr("action");
        var data = t.serialize();
        $.post(action,data,function (json){
            result(t,json);
        },"json");

        return false;
        })

       $(document).on("click",".export-palette",function (e){
            var t = $(this);
            var p = t.parents("form").first();
            var href = t.attr("href");
            var data = p.serialize();
            $.post(href,data,function (json){
                result(p,json);
            },"json");

            return false;
        })


    $(document).on("click", ".save-palette", function(e) {
        var t = $(this);
            var p = t.parents("form").first();
            var href = t.attr("href");
            var img = p.formpng();
            p.find(".png").val(img.imgData);

            var data = p.serialize();

            $.post(href,data,function (json){
                result(p,json);
            },"json");
        return false;
    })

        $(document).on("click",".png-palette",function (e){
            e.preventDefault();
            var t = $(this);
            var p = t.parents("form").first();
            var img = p.formpng();
            console.log(img);
            var a = $("<a>",{"href":img.img.attr("src"),"class":"block c-7","download":"palette-"+p.find("[name=title]").val()+".png"}).html("télécharger l'image");
            var divResult = $("<div>",{"class":"text-center"}).append(a).append(img.img);
            var json = {
                data:divResult,
                infotype:"success"
            };
            result(p,json);
       })
        $('[data-toggle="tooltip"]').tooltip();
});