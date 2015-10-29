<?php 
	
	$config = $c->getJson(DIR_SNIPPETS_CONFIG);
?>
<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="modal-title" class="modal-title">Configuration</h4>
      </div>
      <div id="modal-body"  class="modal-body">

<form action="exec/config-save.php" id="config-save">
<table class="table" id="category-list">
<thead>
	<tr>
		<th>Color</th>
		<th>Title</th>
		<th>Prefix <a href="#" class="help" title="Vous pouvez ajouter un séparateur '|' "><i class="glyphicon glyphicon-question-sign"></i></a></th>
		<th></th>
	</tr>
</thead>
	<tbody>
		<?php foreach ($config["category"] as $key => $value): ?>
			<tr class="category-line">
				<td><div class="c-preview w-20" style="background-color: <?php echo $value["color"];  ?>">&nbsp;</div><input class="w-60 c-preview-value" type="text" name="color[]" value="<?php echo $value["color"];  ?>"/></td>
				<td><input type="text" name="title[]" value="<?php echo $value["title"];  ?>"/></td>
				<td><input type="text" name="prefix[]" value="<?php echo $value["prefix"];  ?>"/></td>
				<td><button class="btn btn-xs remove-line"><i class="glyphicon glyphicon-remove"></i></button></td>
			</tr>
		<?php endforeach ?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="4"><a href="#" id="category-add" class="btn bg-1 c-7 btn-xs"><i class="glyphicon glyphicon-plus "></i> Ajouter</a></td>
		</tr>
	</tfoot>
</table>
<hr/>
<button id="config-submit" class="btn btn-primary w-100">save config</button>
</form>
 </div>