<!-- BEGIN COL : col-md-6 col-lg-6  -->
<div class="col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3 relative top-1 bg-7 no-pad">
<div class="w-50 pull-left">
<div class="pad-5">
<h1>Mon compte</h1>
<hr>
	<?php 
		$form  =  $c->form("user","formUser");
		$form->put([
			"User"=>"Mon nom",
			"UserFirstname"=>"UserFirstname",
			"UserLastname"=>"UserLastname",
			"UserMail"=>"monnom@mondomain.fr"
			]);
		$form->getForm();
	?></div>
	</div>
<div class="w-50 bg-2 pull-left">dsqdgrgrer</div>
</div>
<!-- END COL : col-md-6 col-lg-6  -->

