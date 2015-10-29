<div class="relative top-1">
<?php $form  =  $c->form("user","formLogin"); ?>
<?php $form->start(); ?>
<!-- BEGIN COL : col-md-4 col-lg-4  -->
<div class="col-md-4 col-lg-4 col-md-offset-4 col-lg-offset-4  bg-7 pad-5">
<h1>Se connecter</h1>
<hr>
<div class="msg-info">
	Pas encore de compte ? <?php $c->routePage("user_page_index","créer un compte"); ?>
</div>
	<?php 
		
		$form->getItem("User");
		$form->getItem("UserPassword");
		?>
<div class="rememeber-me">
	<?php $form->getItem("UserRemember","","",false); ?>
</div>
		<?php
		$form->getItem("submit");
	?>
</div>
<!-- END COL : col-md-4 col-lg-4  -->
<?php $form->end(); ?>
</div>