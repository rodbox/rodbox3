<!-- BEGIN COL : col-md-8 col-lg-8  -->
<div class="col-md-8 col-lg-8 line-9 bg-2 no-margh no-padh">
	<form action="#" id="manage-models" class="line-9">
        <div class="bg-8">
            <?php $c->view('docmaker','tabs-list');?>
        </div>
        <?php $c->view('docmaker','models-editor');?>
    </form>
</div>
<!-- END COL : col-md-8 col-lg-8  -->
<!-- BEGIN COL : col-md-4 col-lg-4  -->
<div class="col-md-4 col-lg-4 line-9 bg-8 no-margh no-padh">
	<?php  $c->view('docmaker','zone-preview');?>
</div>
<!-- END COL : col-md-4 col-lg-4  -->