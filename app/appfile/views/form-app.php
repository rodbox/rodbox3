<form  action="<?php $c->execUrl("appfile","create-app");?>" class="app-generator">
	<div class="text-center c-7 padv-5"><i class="glyphicon glyphicon-plus"></i></div>
      <input type="text" name="appName" class="form-control"  placeholder="app name"  />
		<textarea name="description" class="form-control"  placeholder="description" ></textarea>

	
  	<button class="btn btn-primary w-100">create</button>
</form>