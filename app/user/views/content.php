<!-- BEGIN COL : col-md-4 col-lg-4  -->
<div class="col-md-4 col-lg-4 col-md-offset-4 col-lg-offset-4 relative top-1 bg-7 pad-5">
<h1>Inscription</h1>
<hr>
<div class="msg-info">
	Vous avez déja un compte <?php $c->routePage("user_page_login","Se connecter"); ?>
</div>
	<?php 
	$form  =  $c->form("user","formUser");
	$form->start();
	?>
	<!-- BEGIN COL : col-md-6 col-lg-6  -->
	<div class="col-md-6 col-lg-6 ">
		<?php 
			$form->getItem("User");
			$form->getItem("UserMail");
			$form->getItem("UserPassword");
			$form->getItem("UserPassword_confirm");
		?>
	</div>
	<!-- END COL : col-md-6 col-lg-6  -->
	<!-- BEGIN COL : col-md-6 col-lg-6  -->
	<div class="col-md-6 col-lg-6 ">
		<?php
			$form->getItem("UserCiv");
			$form->getItem("UserFirstname"); 
			$form->getItem("UserLastname");
		?>
	</div>
	<!-- END COL : col-md-6 col-lg-6  -->

	<!-- BEGIN ROW  -->
	<div class="row ">
	<!-- BEGIN COL : col-md-12 col-lg-12  -->
	<div class="col-md-12 col-lg-12 ">
	<hr>
		<?php 
			$form->getItem("submit",["class"=>"bg-8 c-7  w-100 block pad-3 no-border"]);
		?>
	</div>
	<!-- END COL : col-md-12 col-lg-12  -->
	</div>
	<!-- END ROW  -->
<?php $form->end(); ?>
</div>
<!-- END COL : col-md-4 col-lg-4  -->
