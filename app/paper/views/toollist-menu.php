<?php 
$dir = DIR_PAPERTOOL;
$list = rscandir($dir);
?>
<div class="btn-group">
<?php foreach ($list as $key => $value): ?>
	 <a href="#" class="btn btn-xs btn-primary" onclick="<?php echo $value; ?>.activate();"><?php echo $value; ?></a>
<?php endforeach ?>
</div>
