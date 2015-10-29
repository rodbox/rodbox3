<?php foreach ($d as $key => $value):?>
	<a href="<?php echo WEB_PHOTOS."/000/".$value ?>" class="cover img-preview" style="background-image: url(<?php echo WEB_PHOTOS."/000/".$value ?>);">
	<span class="marg-2 c-7 small opacity"><?php echo $key+1; ?></span>
	</a>
<?php endforeach;  ?>