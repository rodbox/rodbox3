$(document).ready(function(){

$(document).on("click change keydown keyup","#palettes-list",function (e){
	var t = $(this);
	var val = t.val();
	var imgUrl = "http://192.168.1.44/rodbox3/app-public/palettes/"+val+"/"+val+".png";
	var img = $("<img>",{"src":imgUrl})
	$(".palette-preview").html(img);

})
$(".palette-preview").draggable()

$(document).on("click",".alias",function (e){
	var t = $(this);
	$(t.attr("href")).trigger('click');
	
	
})

$('.selectpicker').selectpicker({
    style: '',
    size: 6
});


});