$(document).ready(function(){

	//  HEX TO RGB 
	// source = http://www.javascripter.net/faq/hextorgb.htm

	$('#color-hex').on("change keyup mouseup",function (){
		var t = $(this);
		var colorHex = t.val();
		$('.exempleHex')
		function cutHex(h) {return (h.charAt(0)=="#") ? h.substring(1,7):h}

		var R = parseInt((cutHex(colorHex)).substring(0,2),16)
		var G = parseInt((cutHex(colorHex)).substring(2,4),16)
		var B = parseInt((cutHex(colorHex)).substring(4,6),16)

		$('#toRGB').css({"background-color":"#"+colorHex}).find(".value").html(R+","+G+","+B);
	})


	// RGB to HEX
	// source = http://www.javascripter.net/faq/rgbtohex.htm

	$("input.rgb").on("change keyup mouseup",function (){

		function rgbToHex(R,G,B) {return toHex(R)+toHex(G)+toHex(B)}
		function toHex(n) {
			 n = parseInt(n,10);
			 if (isNaN(n)) return "00";
			 n = Math.max(0,Math.min(n,255));
			 return "0123456789ABCDEF".charAt((n-n%16)/16)
			      + "0123456789ABCDEF".charAt(n%16);
		}

		var t = $(this);

		var R = $("#valR").val();
		var G = $("#valG").val();
		var B = $("#valB").val();

		var valHex = rgbToHex(R,G,B);

		$('#toHEX').css({"background-color":"#"+valHex}).find(".value").html("#"+valHex);
	});

	$('#color-hex,input.rgb').trigger("keyup");


});