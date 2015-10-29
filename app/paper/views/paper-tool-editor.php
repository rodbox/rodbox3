<form action="exec/save-tool.php" class="save-tool">

<ul class="no-pad paper-edit-tool">
<li>
	<div class="block margv-5"><?php  $c->view('paper','toollist','toollist');?></div>
	<a href="#" id="new-tool" class=" btn btn-xs btn-primary" data-form=".save-tool"> New</a>
	<a href="exec/edit-tool.php" id="open-tool" class="btn btn-xs btn-primary " data-form=".save-tool">open</a>
	<a href="exec/save-tool.php?save=save_as" class="save-as btn btn-xs btn-primary" data-form=".save-tool"><i class="glyphicon glyphicon-floppy-disk"></i> save as</a>

	<a href="exec/save-tool.php?save=save" class="applive btn btn-xs btn-primary" data-form=".save-tool"><i class="glyphicon glyphicon-floppy-disk"></i></a>

	<a href="exec/compile-tools.php" class="applive btn btn-xs btn-primary" data-form=".save-tool"><i class="icomoon-hammer "></i> compile</a>
</li>
	<li>
		<label for="toolFileMenu">toolName</label>
		<input type="text" name="toolName" id="toolName" value="" class="tool-name"/>
	</li>
	<li>
		<label for="onInit">onInit</label>
		<textarea id="onInit" name="onInit" class="tool-event"></textarea>
	</li>
	<li>
		<label for="onFrame">onFrame</label>
		<textarea id="onFrame" name="onFrame" class="tool-event"></textarea>
	</li>
	<li>
		<label for="onResize">onResize</label>
		<textarea id="onResize" name="onResize" class="tool-event"></textarea>
	</li>
	<li>
		<label for="onMouseDown">onMouseDown</label>
		<textarea id="onMouseDown" name="onMouseDown" class="tool-event"></textarea>
	</li>
	<li>
		<label for="onMouseDrag">onMouseDrag</label>
		<textarea id="onMouseDrag" name="onMouseDrag" class="tool-event"></textarea>
	</li>
	<li>
		<label for="onMouseMove">onMouseMove</label>
		<textarea id="onMouseMove" name="onMouseMove" class="tool-event"></textarea>
	</li>
	<li>
		<label for="onMouseUp">onMouseUp</label>
		<textarea id="onMouseUp" name="onMouseUp" class="tool-event"></textarea>
	</li>
	<li>
		<label for="onKeyDown">onKeyDown</label>
		<textarea id="onKeyDown" name="onKeyDown" class="tool-event"></textarea>
	</li>
	<li>
		<label for="onKeyUp">onKeyUp</label>
		<textarea id="onKeyUp" name="onKeyUp" class="tool-event"></textarea>
	 </li>
	 <li>
	 	<label for="toolFileMenu">toolFileMenu</label>
		<input type="text" name="toolFileMenu" id="toolFileMenu" value="" class="tool-filemenu"/>
	 </li>
 </ul>

 </form>