<!-- BEGIN COL : col-md-4 col-lg-4  -->
<div class="col-md-4 col-lg-4 col-md-offset-4 col-lg-offset-4 relative  top-1 bg-7  c-8 no-pad">
	<div class="pad-5 bg-8">
		<div class="text-center" id="user-identity-upload">
			<div class="handraw-help c-7 right">Uploadez votre photo
			<br><?php $c->img("app","arrow-handdraw.svg"); ?>
			</div>
			<div class="circle open marg-top-6" >
			  	<div class="circle-1 pos-9 elem">
					<?php $c->routeExec("user_exec_rotate_img",'<i class="fa fa-rotate-right"></i>',["rotate"=>"-90"],["class"=>"rotate-user-img big"]);?>
				</div>
				<div class="circle-1 pos-2 elem">
					<?php $c->routeExec("user_exec_rotate_img",'<i class="fa fa-rotate-left"></i>',["rotate"=>"90"],["class"=>"rotate-user-img big"]);?>
				</div>
				<div class="circle-1 pos-1 elem">
					<a href="#" class="bt-modal-route big"><i class="fa fa-crop "></i></a>
				</div>
			    <div class="circle-center">
			    	<?php $c->service("plupload","user_exec_upload_img","user_exec_upload_img"); ?>
					<?php $c->service("userImg",["id"=>$_SESSION["user"]["id"]],""); ?>
					<input type="text" id="upload-progress" class="dial" value="">
				</div>
			</div>
			<?php $d = $c->model("user","user_edit",["id"=>$_SESSION["user"]["id"]]); ?>
			<p class="block big c-7 marg-top-7"><?php echo  $_SESSION["user"]["username"]; ?></p>
			<p class="block small c-7"><?php echo  $d["UserRole"]; ?></p>
		</div>	
	</div>	
	<div class="pad-5">
		<p class="small pull-right"><?php echo $d["UserDateUpd"]->format('d-m-Y H:i:s'); ?></p>
		<?php 
			$form  =  $c->form("user","formUserEdit");
			$form->put($d);
			$form->getForm();
		?>
	</div>
</div>
<!-- END COL : col-md-4 col-lg-4  -->