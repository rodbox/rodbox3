<!-- BEGIN NAVTABS : title  -->
<ul class="nav nav-tabs " id="docmaker-editor">
    <li class="">
        <a data-toggle="tab" href="#docmaker-editor-tab-1" aria-expanded="false">Fichier</a>
    </li>
    <li class="">
        <a data-toggle="tab" href="#docmaker-editor-tab-2" aria-expanded="false">Edition </a>
    </li>
    <li class="">
        <a data-toggle="tab" href="#docmaker-editor-tab-3" aria-expanded="false">Paramètres </a>
    </li>
   <!--  <li class="">
        <a data-toggle="tab" href="#docmaker-editor-tab-5" aria-expanded="false">Ressources </a>
    </li> -->
    
    <li class="pull-right">
        <a id="pdf-model" href="exec/pdf-doc.php"><i class="glyphicon glyphicon-eye-open"></i></a>
    </li>
    <li class="pull-right">
        <a class="alias" href="#save-model"><i class="glyphicon glyphicon-floppy-disk"></i></a>
    </li>
    <li class="pull-right">
        <a data-toggle="tab" href="#docmaker-editor-tab-4"><i class="glyphicon glyphicon-cog"></i></a>
    </li>
</ul>
<!-- END NAVTABS : title  -->
<!-- BEGIN TABSCONTENT  -->
<div class="tab-content bg-8">
    <div id="docmaker-editor-tab-1" class="tab-pane ">
	<?php  $c->view('docmaker','tab-file');?>
    </div>
    <div id="docmaker-editor-tab-2" class="tab-pane">
	<?php  $c->view('docmaker','tab-edit');?>
    </div>
    <div id="docmaker-editor-tab-3" class="tab-pane">
    <?php  $c->view('docmaker','tab-param');?>
    </div>
    <div id="docmaker-editor-tab-4" class="tab-pane">
    <?php  //$c->view('docmaker','tab-codemirror-config');?>
    </div>
    <div id="docmaker-editor-tab-5" class="tab-pane">
	<?php  //$c->view('docmaker','tab-ressources');?>
    </div>

   
</div>
<!-- END TABSCONTENT  -->
<span class="small palette-preview"></span>