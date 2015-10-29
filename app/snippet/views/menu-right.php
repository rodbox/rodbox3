<li><a class="btn" href="#"><span class="opacity small "><span id="countselect" class="c-4">0</span> / <span id="snippets-count" class="c-4"></span></span></a></li>
<li><a href="#" id="snippets-toggle-views" class="btn btn-xs" title="filter les éléments selectionnés" data-rel="tooltip" data-placement="left"><i class="glyphicon glyphicon-eye-open"></i></a></li>
<li><a href="#" id="snippets-toggle" class="btn btn-xs" title="Selectionner / Deselectionner tout les éléments visibles de la liste" data-rel="tooltip" data-placement="left"><i class="glyphicon glyphicon-ok"></i></a></li>
<li><?php 
	$dataConfigPdf = [
		"id" 				=> "snippets-config-pdf",
		"class" 			=> "btn btn-xs bt-modal",
		"title" 			=> "Exporter au format PDF",
		"data-toggle" 		=> "modal",
		"data-modal-title" 	=> "Configuration",
		"data-target"		=> "#myModal",
		"data-rel"			=>"tooltip",
		"data-placement"	=>"left"
	];

	$c->routeView("snippet","config-pdf",'<i class="glyphicon glyphicon-book"></i>','',$dataConfigPdf); 
?></li>

<li>
<?php
	$dataZip = [
		"id" 				=> "snippets-zip",
		"class" 			=> "btn btn-xs bt-modal",
		"title" 			=> "Exporter tout les snippets selectionner",
		"data-toggle" 		=> "modal",
		"data-modal-title" 	=> "Configuration",
		"data-target"		=> "#myModal",
		"data-rel"			=>"tooltip",
		"data-placement"	=>"left"
	];

	$c->routeView("snippet","zip",'<i class="glyphicon glyphicon-compressed"></i>','',$dataZip); 
?></li>
<li>
<?php
	$dataConfig = [
		"id" 				=> "snippets-config",
		"class" 			=> "btn btn-xs bt-modal",
		"title" 			=> "Configuration des categories",
		"data-toggle" 		=> "modal",
		"data-modal-title" 	=> "Configuration",
		"data-target"		=> "#myModal",
		"data-rel"			=> "tooltip",
		"data-placement"	=> "left"
	];

	$c->routeView("snippet","config",'<i class="glyphicon glyphicon-cog"></i>','',$dataConfig); 
?></li>
<li><div class="input-group  marg-top-3  marg-right-3" >
    <span class="input-group-addon  bg-4"><i class="glyphicon glyphicon-search"></i></span>
    <input id="snippets-finder" type="text" autocomplete="off" class="form-control bg-4" id="snippets-finder" data-target="#snippets-list" data-target-scroll="#snippet-list-col">
</div></li>