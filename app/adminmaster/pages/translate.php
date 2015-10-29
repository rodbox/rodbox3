<!-- BEGIN COL : col-md-10 col-lg-10  -->
<?php 
    $langList = $_SESSION["user"]["lang"];
    $appList = $c->model("adminmaster","app-list");
    $langFilter = "";
?>

<div class="col-md-10 col-lg-10 col-md-offset-1 col-lg-offset-1 top-1">
<h1>Traduction <?php $c->routeExec("adminmaster_exec_compile_msg","compile","",["class"=>"small appliveexec"]); ?>
<?php 

foreach ($langList as $keyLang => $valueLang){
    $filterID = 'filter_'.$valueLang;
    $langFilter .= '<li><input type="checkbox" value="" id="'.$filterID.'" data-lang="'.$valueLang.'" checked class="filter-lang filter_'.$valueLang.'"/><label for="'.$filterID.'" class="forcheckbox "> </label>'.$c->flag($valueLang).'</li>';
}
?>

 <div class="task-config-btn btn-group pull-right big">
            <a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" href="#" class="btn btn-xs default">
            <i class="fa fa-cog"></i> <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu pull-right">
                <?php echo $langFilter; ?>
            </ul>
        </div>
</h1>

    <?php
    
    foreach ($appList as $key => $app):?>
<form action="<?php echo $c->routeExecUrl("adminmaster_exec_msg_save"); ?>" class="pad-2 appliveformMsg">
<?php 

foreach ($langList as $keyLang => $valueLang){
	$msgFileDir = DIR_APP."/".$app."/msg/".$valueLang.".json";
	if(!file_exists($msgFileDir))
		file_put_contents($msgFileDir, "{}");
	$msgFile = $c->getJson(DIR_APP."/".$app."/msg/".$valueLang.".json");
	$msgAppList[$app][$valueLang] = (is_array($msgFile))?$msgFile:[];

}
?>


<!-- BEGIN RB PORTLET : title  
    options : 
        .default .inverse pour utiliser les couleurs predefinit
        .portlet-footer-active pour afficher le footer du protlet
        .line-1 2 ou 3 pour definir la hauteur du protlet
-->
<div class="portlet default ">
    <div class="portlet-title tabbable-line">
        <div class="caption">
            <i class="icon-icon "></i>
            <span class="caption-subject   bold uppercase"><?php echo $app; ?></span> <span class="caption-helper">
                <?php $c->routeExec("adminmaster_exec_scan_msg","scan",["app"=>$app],["class"=>"small appliveexec"]); ?>
            </span>
        </div>
        <div class="actions">
       
        <button data-toggle="button" class="btn no-border btn-default btn-xs toggle-portlet-footer" type="button" aria-pressed="false"><i class="fa fa-arrows-v  "></i></button>
                    <button data-toggle="button" class="btn no-border btn-default btn-xs toggle-portlet-fullscreen" type="button" aria-pressed="false"><i class="glyphicon glyphicon-resize-full "></i></button>		</div>
    </div>
    <div class="portlet-body">

	
<!-- /* TABLE */ -->
		 <table class="table table-striped table-bordered no-marg ">
        <thead>
            <tr>
                <th class="w-10 text-right ">id</th>
                <?php foreach ($langList as $keyLang => $valueLang): ?>
                <th style="width :<?php echo 90 / count($langList); ?>%;"  class="lang-<?php echo $valueLang; ?> "> <?php echo $c->flag($valueLang); ?> <span><?php echo $valueLang; ?></span><span id="<?php echo $app."_".$valueLang; ?>" class="small counterProgress" data-target=".<?php echo $app."_".$valueLang; ?>"></span>
                </th>
                <?php endforeach ?>
            </tr>
        </thead>
        <tbody>
			<?php foreach ($msgAppList[$app][LANG_PRINCIPAL] as $keyMsgPrincipal => $valueMsgPrincipal): ?>
            <tr>
                <td class="small text-right strong"><?php echo $keyMsgPrincipal; ?></td>
                <?php foreach ($langList as $keyLang => $valueLang): ?>
                <td class="lang-<?php echo $valueLang; ?> "><?php 
                	// si lang principal on affiche le message
                	if ($valueLang == LANG_PRINCIPAL) {
                			echo '<textarea name="msg['.$app.']['.$valueLang.']['.$keyMsgPrincipal.']"  class="form-control '.$app.'_'.$valueLang.'" >'.$msgAppList[$app][$valueLang][$keyMsgPrincipal].'</textarea>';
                		}
                	// sinon si l'id n'est pas traduit le champ est vide
                	else if(isset($msgAppList[$app][$valueLang][$keyMsgPrincipal])):?>
						<textarea name="msg[<?php echo $app; ?>][<?php echo $valueLang; ?>][<?php echo $keyMsgPrincipal; ?>]"  class="form-control <?php echo $app."_".$valueLang; ?>" ><?php echo $msgAppList[$app][$valueLang][$keyMsgPrincipal]; ?></textarea>
					<?php else: ?>
						<textarea name="msg[<?php echo $app; ?>][<?php echo $valueLang; ?>][<?php echo $keyMsgPrincipal; ?>]"  class="form-control <?php echo $app."_".$valueLang; ?>"></textarea>
                <?php endif ?>
                </td>
                <?php endforeach ?>
            </tr>
			<?php endforeach; ?>
        </tbody>
    </table>
<!-- /* END TABLE */ -->
   
   
    </div>
    <div class="portlet-footer ">
     <input type="submit" name="" value="Save" class="w-100 text-center big pad-5 bg-2 c-7 no-border" />
    </div>

</div>
   </form>
<!-- END RB PORTLET : title -->

   <?php $langFilter=""; ?>
    <?php endforeach; ?>
</div>
<!-- END COL : col-md-10 col-lg-10  -->
<?php
// foreach ($langList as $keyLang => $valueLang) {
// 	$msgDir = DIR_APP."/".$app."/msg";
// 	$msgFile = $msgDir."/".$valueLang.".json";
// 	$msgOldFile = $msgDir."/msg.xml";
// 	if(!file_exists($msgDir)){
// 		mkdir($msgDir);
// 		file_put_contents($msgFile, "");
// 	}
// 	elseif (!file_exists($msgFile)){
// 		file_put_contents($msgFile, "");
// 	}
// 	if(file_exists($msgOldFile))
// 		unlink($msgOldFile);
// } ?>