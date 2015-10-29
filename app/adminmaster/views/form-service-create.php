<form action="<?php echo $c->routeExecUrl("adminmaster_exec_create_service"); ?>" class="pad-2 appliveform">
<?php 
	$c->help("Créer un service ! NB : ne pas oublier de la compiler dans le kernel");
	$c->service("app");
 ?>
	<input type="text" name="service-controller" class="form-control form-control-xs inline w-25"  placeholder="controller" >
	<input type="text" name="service-method" class="form-control form-control-xs inline w-25"  placeholder="method" >
	<input type="submit" class="btn-primary btn btn-xs" value="Créer">
	
 </form>