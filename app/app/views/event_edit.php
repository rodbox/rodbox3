<div class="navbar"><span class="small pull-right">id : <?php echo $d['id']; ?></span>
	<?php $service=	$c->service("eventRemove",$d); ?>
</div>

<?php 
	$c->form("app","formEvent"); 
	$form = new formEvent;

	$form->put([
		"title"=>$d["title"],
		"type"=>$d["type"],
		"start"=>$d["start"],
		"end"=>$d["end"],
		"startTime"=>"12:00",
		"endTime"=>"12:00",
		"description"=>$d["description"]
	]);
	$form->start();
	
	$form->getItem("title");
	$form->getItem("description");
	?>
	<div class="w-50 pull-left pad-right-2">
		<?php $form->getItem("start"); ?>
		<?php $form->getItem("startTime"); ?>
	</div>
	<div class="w-50 pull-right pad-left-2">
		<?php $form->getItem("end"); ?>
		<?php $form->getItem("endTime"); ?>
	</div>
	<div class="clearfix">
	
	</div>
	<?php
	$form->end();
	// $form->getForm();
	?>