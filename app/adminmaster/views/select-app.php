<select id="app-select" name="app-select" class="selectpicker ">
<?php foreach ($d as $key => $value): ?>
	<option value="<?php echo $value ?>"> <?php echo $value; ?> </option>
<?php endforeach ?>
</select>