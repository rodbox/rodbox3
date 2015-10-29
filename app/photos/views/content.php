<!-- BEGIN COL : col-md-6 col-lg-6  -->
<div class="col-md-6 col-lg-6 col-md-offset-1 col-lg-offset-1 text-center">
	<input id="frame" type="range" min="1" max="25" />	
	<?php $c->view("photos","photo-list","photo-list"); ?>
</div>
<!-- END COL : col-md-6 col-lg-6  -->
<!-- BEGIN COL : col-md-4 col-lg-4  -->
<div id="preview" class="cover col-md-4 col-lg-4 line-4 bg-7">

</div>
<!-- END COL : col-md-3 col-lg-3  -->
<?php $c->view("photos","photo-footer"); ?>
