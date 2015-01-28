<?php

$dir    = DIR_DOC;
$list   = rscandir($dir,"dir");
?>
<div class="" >
    <ul>
        <li><a id="new-model" href="exec/create-doc.php" class="">Nouveau</a></li>
        <li><select id="select-models" name="models" id="" class="selectpicker c-8">
            <option value=""></option>
            <?php foreach ($list as $key => $value): ?>
                <?php $val = str_replace(".php", "", $value); ?>
            <option class="text-left" value="<?php echo $val ?>"><?php echo $val ?></option>
            <?php endforeach ?>
        </select><a id="open-model" href="exec/edit-doc.php" class="btn">Ouvrir</a></li>
        <li><input type="text" class="btn-fix sbg-2" name="new-file" id="new-file"> <a id="save-model" href="exec/save-doc.php" class="btn"><i class="glyphicon glyphicon-floppy-disk"></i></a></li>
    </ul>
   
</div>