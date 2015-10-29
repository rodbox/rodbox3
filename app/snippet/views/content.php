<!-- BEGIN COL : col-md-8 col-lg-8  -->
<div class="col-md-8 col-lg-8 bg-8 line-9">
<div class="margv-5">
		<button id="snippet-new" class="btn bg-1 c-7 ">Nouveau</button>
	<?php $c->routeExec("snippet_exec_del",'<i class="glyphicon glyphicon-remove"></i> Supprimer','',[
		"class"=>"pull-right bt-snippet-del none btn bg-1 c-7",
		"id"=>"snippet-del"
	]); ?>
</div>

  <?php $form = $c->form("snippet","formSnippet");
  $form->getForm();
  ?>
	<?php $c->view("snippet","follower"); ?>	
</div>
<!-- END COL : col-md-8 col-lg-8  -->
<!-- BEGIN COL : col-md-4 col-lg-4  -->
<div class="col-md-4 col-lg-4 bg-2 line-9 scroll-touch scroll-auto">
	<?php $c->view("snippet","snippet-list","snippet-list"); ?>	
</div>
<!-- END COL : col-md-4 col-lg-4  -->
