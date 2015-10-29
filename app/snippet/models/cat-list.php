<?php
	$json = $c->getJson(DIR_SNIPPETS_CONFIG);

	foreach($json["category"] as $key => $value){
    	$d[$key] = $key;
    }

?>