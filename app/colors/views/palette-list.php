<ul id="palette-list" class="no-margh no-pad no-marg">
<?php foreach ($d as $key => $value):?>
	<li class="palette"><?php
	// echo DIR_PALETTES."/".$value."/".$value.".json";
	$d = json_decode(file_get_contents(DIR_PALETTES."/".$value."/".$value.".json"),true);
	$c->view('colors','palettes-single','',$d);
	?></li>
<?php endforeach ?>
</ul>