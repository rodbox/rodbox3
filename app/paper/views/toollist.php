<select name="tool" id="tool" class="selectpicker">
<option value=""></option>
<?php foreach ($d as $key => $value): ?>
	<option value="<?php echo $value; ?>">
	<?php echo $value; ?>
	</option>
<?php endforeach ?>
</select> 