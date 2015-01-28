<?php 
$dir = DIR_PAPERPRESET;
$list = rscandir($dir);
?>
<ul>
<?php foreach ($list as $key => $value): ?>
	<li>
	 <a href="#" class="btn btn-xs btn-primary" ><?php echo $value; ?></a>
	 </li>
<?php endforeach ?>

</ul>