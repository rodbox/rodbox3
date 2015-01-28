
<?php 

$d = scandir(realpath("./snippets"));
$d = array_diff($d, array(".","..",".DS_Store",".sublime-snippet"));
  ?>

<form action="#" id="form-snippets-list">

<ul class="no-padh snippets-list" id="snippets-list">
<?php foreach ($d as $key => $value): ?>
	<?php $infos = pathinfo($value); 
		$f = $infos["filename"]; 
		$e = $infos["extension"]; 
	?>
	<li id="<?php echo $f;  ?>">
	<input type="checkbox" value="<?php echo $f  ?>" name="snippet-file[]" id="snippet-file-<?php echo $f; ?>"/><label for="snippet-file-<?php echo $f; ?>" class="forcheckbox "> </label>
	<a href="snippets/<?php echo $value; ?>" download="<?php echo $value;  ?>" class=" bt-snippet-dl"><i class="glyphicon glyphicon-floppy-disk"></i></a>
		<a href="snippets/<?php echo $value; ?>" data-filename="<?php echo $f;?>" data-fileext="<?php echo $f;?>" class="snippet-edit c-7"><?php echo $f; ?></a>
	</li>
<?php endforeach ?>

</ul>
<li id="liModel" class="none new-snippet">
<input type="checkbox" value="[FILE]" name="snippet-file[]" id="snippet-file-[FILE]"/><label for="snippet-file-[FILE]" class="forcheckbox "> </label>
	<a href="snippets/[FILE].sublime-snippet" download="[FILE]"class="absolute bt-snippet-dl"><i class="glyphicon glyphicon-floppy-disk"></i></a>
		<a href="snippets/[FILE].sublime-snippet" data-filename="[FILE]"data-fileext="sublime-snippet" class="snippet-edit c-7">[FILE]<span class="opacity small c-3">.sublime-snippet</span></a>
	</li>
</form>
