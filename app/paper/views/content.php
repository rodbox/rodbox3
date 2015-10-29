<!-- BEGIN COL : col-md-4 col-lg-4  -->
<div class="col-md-4 col-lg-4 bg-8 c-7 line-9 overflow-auto">
	<?php  $c->view('paper','paper-tool-editor');?>
</div>
<!-- END COL : col-md-4 col-lg-4  -->

<!-- BEGIN COL : col-md-5 col-lg-5  -->
<div class="col-md-5 col-lg-5 bg-2 line-6 no-marg no-pad">
<div id="papermenu">
	<?php  $c->view('paper','papermenu');?>
</div>
<div class="text-center top-1 line-2 relative">
	<canvas id="myCanvas"></canvas>
	</div>
</div>
<!-- END COL : col-md-5 col-lg-5  -->
<!-- BEGIN COL : col-md-3 col-lg-3  -->
<div class="col-md-3 col-lg-3 bg-8 line-6 ">
	<?php  $c->view('paper','paper-preset-editor');?>
</div>
<!-- END COL : col-md-3 col-lg-3  -->

<!-- BEGIN COL : col-md-8 col-lg-8  -->
<div class="col-md-8 col-lg-8 bg-2 col-md-offset-4 col-lg-offset-4 line-3 top-6 absolute">
	
</div>
<!-- END COL : col-md-8 col-lg-8  -->