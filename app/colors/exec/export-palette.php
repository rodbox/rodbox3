<?php 
/* export au format LESS*/
$data = "";
$data .= "// Rodbox.fr<br/>";
$data .= "// Title : ".$_POST["title"]."<br/>";
$data .= "// Date : ".date("d m Y - h:i")."<br/>";
$data .= "@colors : ".implode($_POST["color-value"],", ").";<br/>";
$data .= "@names : ".implode($_POST["color-name"],", ").";";

$r = array(
            'infotype'=>"success",
            'msg'=>"ok",
            'data'=>$data
        );


 ?>