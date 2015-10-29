<?php foreach ($d["roleList"] as $key => $value): ?>
	<input type="checkbox" value="<?php echo $value; ?>" name="role[]" id="<?php echo $d["id"].$key; ?>" <?php echo (in_array($value,$d["checked"]))?"checked":""; ?> /><label for="<?php echo $d["id"].$key; ?>" class="forcheckbox "><?php echo $value; ?></label>
<?php endforeach ?>
