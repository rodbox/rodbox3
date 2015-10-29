<!-- BEGIN COL : col-md-6 col-lg-6  -->
<div class="col-md-4 col-lg-4 col-md-offset-4 col-lg-offset-4 relative top-1 bg-7 pad-5">
<h1><?php echo $c->msg("user","registration") ?></h1>
<hr>
<div class="msg-info">
	<?php echo $c->msg("user","have_account") ?> <?php $c->routePage("user_page_login","Se connecter"); ?> 
</div><?php 
	$form  =  $c->form("user","formUser");
	$form->getFormByStep();
 ?>
</div>
<!-- END COL : col-md-6 col-lg-6  -->
