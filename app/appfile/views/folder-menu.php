<div class="appfile-foldermenu">
	<form action="<?php $c->execUrl("appfile","create"); ?>" class="file-create" >
        <input type="hidden" name="location" id="location" />
        <input type="text" class="form-expander form-control input-control autoclear autofocus"  name="file_create" autocomplete="off" />
            <select name="file_type" class="select-xs selectpicker">
                <option value="dir">folder</option>
                <option value="readme.md" >readme</option>
                <option value="php.php" selected="selected">php</option>
              	<option value="controller.php">controller</option>
                <option value="upload.php">upload</option>
                <option value="index.php">index</option>
                <option value="exec.php">exec</option>
                <option value="view.php">view</option>
                <option value="js.js">js</option>
                <option value="json.json">json</option>
                <option value="style.less">less</option>
            </select>
            <button class="btn btn-primary" type="submit">Créer</button>
        </div>
	</form>
</div>