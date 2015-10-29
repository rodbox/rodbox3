<!-- <!-- BEGIN COL : col-md-3 col-lg-3  -->
<div id="app-sidebar" class="col-md-3 col-lg-3 bg-8 line-9 ">
	<?php 

$attr = [
	"class"=>"appfile",
	"data-auto-open"=>(isset($_GET["file"]))?$_GET["file"]:'',
	"data-auto-open-line"=>(isset($_GET["line"]))?$_GET["line"]:'1'
	];
	$c->routeExec("appfile_exec_list","","",$attr);
	?>
<div class="clearfix"></div>
<div id="pack-create" class="bottom fixed bg-2 padv-5 ">
  <?php $c->view("appfile","form-app");?>

 </div>
</div>
<!-- END COL : col-md-3 col-lg-3  -->

<!-- BEGIN COL : col-md-9 col-lg-9  -->
<div id="app-content" class="col-md-9 col-lg-9 line-9 no-marg no-pad">
	<?php  $c->view("appfile","appfilemenu");?>
	  <?php $c->view("appfile","form-msg");?>
	<textarea id="myTextarea" name="myTextarea" class="line-9"></textarea>
</div>
<!-- END COL : col-md-9 col-lg-9  -->
	
