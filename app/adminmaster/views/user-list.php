<?php
foreach ($d as $key => $value){
	$c->service("userIdentity",["id"=>$value->getId()]);
}
?>