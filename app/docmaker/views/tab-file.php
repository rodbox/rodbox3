<div class="" >
    <ul>
        <li><a id="new-model" href="exec/create-doc.php" class="">Nouveau</a></li>
        <li>
            <?php  $c->service("getDocList"); ?>
            <?php $c->routeExec("docmaker_exec_edit-doc","Ourvir","",["id"=>"open-model","class"=>"btn"]); ?>
        </li>
        <li><input type="text" class="btn-fix sbg-2" name="new-file" id="new-file"> 
        <?php $c->routeExec("docmaker_exec_save-doc",'<i class="glyphicon glyphicon-floppy-disk"></i>',"",["id"=>"save-model","class"=>"btn"]); ?></li>
    </ul>
   
</div>