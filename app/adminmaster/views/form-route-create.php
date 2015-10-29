<form action="<?php echo $c->routeExecUrl("adminmaster_exec_create_route"); ?>" class="pad-2 appliveform">
<?php 
	$c->help("Créer une route ! NB : ne pas oublier de la compiler dans le kernel");
	$c->service("app");
 ?>
	<input type="text" name="route-file" class="form-control form-control-xs inline w-25"/>

	<select id="route-type" name="route-type" class="selectpicker ">
		<option value="page">page</option>
		<option value="exec">exec</option>
		<option value="view">view</option>
		<option value="service">service</option>
	</select>
	<?php $c->view("adminmaster","roles-list","roles-list",["id"=>"newRoute","checked"=>["MASTER"]]); ?>
	<input type="submit" class="btn-primary btn btn-xs" value="Créer">
	
 </form>