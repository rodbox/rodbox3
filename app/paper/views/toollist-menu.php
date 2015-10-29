<div class="btn-group">
<?php foreach ($d as $key => $value): ?>
	 <a href="#" class="btn btn-xs btn-primary" onclick="<?php echo $value; ?>.activate();"><?php echo $value; ?></a>
<?php endforeach ?>
</div>
