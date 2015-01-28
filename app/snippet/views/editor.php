<form action="exec/save.php" method="post" id ="snippet-editor" data-new="true" class="marg-top-6">
	<button class="btn bg-1 c-7 " id="snippet-new">Nouveau</button>
	<a href="exec/del.php" data-snippetname="" id="snippet-del" class="pull-right bt-snippet-del none btn bg-3 c-7">
<i class="glyphicon glyphicon-remove"></i> Supprimer
	</a>
	<hr>
	<fieldset>
		<div class="form-group">
			<input type="text" name="snippetName" autocomplete="off" required placeholder="snippetName" class="form-control border-preview">
		</div>
		<div class="form-group">
			<input type="text" name="trigger" autocomplete="off" required placeholder="trigger" class="form-control border-preview">
		</div>

		<textarea id="myTextarea" name="content" placeholder="content" data-follower="#sub" class="form-control border-preview caretposition"></textarea>
		<div class="pad-top-4 pad-bottom-5 small">
			<div class="w-50 pull-left">
				<ul class="no-margh no-padh">
					<li><strong>alt</strong> + <strong><i class="glyphicon glyphicon-arrow-down"></i></strong> pour acceder directement a la fenetre volante</li>
				</ul>
			</div>

			<div class="w-50 pull-right">
				<ul class="no-margh no-padh text-right">
					<li><strong>\$</strong> pour inserer une variable</li>
				</ul>
			</div>
		</div>
		
		<div class="form-group clearfix marg-top-6">
		<label for="name" class="">Description</label>
			<input type="text" name="desc" id="desc" placeholder="description" class="form-control border-preview">
		</div>

		
		<div class="form-group "><label for="type" class="">Scope</label>
			<select name="type" id="type" class="form-control border-preview">
				<option value=""></option>
				<option value="source.php">php</option>
				<option value="source.html">html</option>
				<option value="source.js">javascript</option>
				<option value="source.css">css</option>
				<option value="source.md">md</option>
				<option value="source.twig">twig</option>
			</select>
		</div>
		
		<?php 
		$json = file_get_contents('config.json');
		$configCat = json_decode($json,true);  ?>

		<div class="form-group "><label for="category" class="">Categories</label>
			<select name="category" data-config='<?php echo $json;  ?>' id="category" class="form-control border-preview">
			<?php foreach ($configCat["category"] as $key => $value): ?>
			<option value="<?php echo $key;  ?>" ><?php echo $key;  ?></option>
		<?php endforeach ?>
				
			</select>
		</div>

		<hr>
		<button class="btn btn-primary w-100 bg-2 border-2 marg-bottom-1">Enregistrer</button>
	</fieldset>
</form>

<div id="sub" class="text-center">
	<form action="#" id="tab-helper">
	    <input type="number" id="tabNum" name="tabNum" class="w-20 pull-left c-1" value="1">
	    <input type="text" name="tabContent" id="tabContent" class="w-60 pull-left c-1">
	    <button class="w-20 bg-8 c-7 btn">ok</button>
	    <a href="#" class="bt-close small-2 "><i class="glyphicon glyphicon-remove"></i></a>
	</form>
</div>