<!-- BEGIN COL => col-md-6 col-lg-6  -->
<div class="col-md-6 col-lg-6 bg-7 col-md-offset-3 col-lg-offset-3 line-6 top-1">
	<?php 
		// $validate = $c->form("user","formUser")->validate();
		// echo (!is_array($validate))?"ok"=>"pas ok";
		// 
		$toJson = array(	"req" => "Champ requis",
	"mail" => "Adresse mail non valide",
	"int" => "Doit être un entier",
	"reg" => "Ne correspond pas à l'expression ",
	"alpha_num" => "",
	"min" => "X caractères minimum",
	"max" => "X caractères maximum",
	"equal" => "Valeur non identique à X",
	"url" => "Url non valide",
	"ip" => "Adress IP non valide",
	"tel" => "Numéro de téléphone non valide");


		echo"<pre>";
		print_r(json_encode($toJson,JSON_PRETTY_PRINT));
		echo"</pre>";
	?>
</div>
<!-- END COL => col-md-6 col-lg-6  -->
