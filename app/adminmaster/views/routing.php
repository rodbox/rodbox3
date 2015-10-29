<!-- BEGIN PORTLET : title  -->
<div class="portlet portlet-footer-active">
    <div class="portlet-title tabbable-line">
        <div class="caption">
            <span class="caption-subject"><i class="icomoon-direction"></i> Routes</span> <span class="caption-helper"><?php $c->routeExec("adminmaster_exec_compile_routes","Compile","",["class"=>"appliveexec"]) ?>
            <?php $c->help("Compile toutes les routes des app disponibles vers le kernel.","right"); ?></span>
        </div>
        <div class="actions">
            <button data-toggle="button" class="btn no-border btn-default btn-xs toggle-portlet-footer" type="button" aria-pressed="false"><i class="fa fa-arrows-v  "></i></button>
            <button data-toggle="button" class="btn no-border btn-default btn-xs toggle-portlet-fullscreen" type="button" aria-pressed="false"><i class="glyphicon glyphicon-resize-full "></i></button></div>
    </div>
    <div class="portlet-body">
        <table class="table  table-striped data-table">
            <thead>
                <tr>
                    <th>Route</th>
                    <th>App</th>
                    <th>File</th>
                    <th>Type</th>
                    <th class="td-xl">Security</th>

                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($d as $route => $value): ?>
                    
                <tr>
                    <td><?php if ($value[2]=="page"): ?>
                        <strong><?php $c->routePage($route,$route,"",["target"=>"_blank"]); ?></strong>
                    <?php else: ?>
                        <?php echo $route; ?>
                    <?php endif ?></td>
                    <td><?php echo $value[0]; ?></td>
                    <td><?php echo $value[1]; ?></td>
                    <td><?php echo $value[2]; ?></td>
                    <td>
                    <form action ="<?php echo $c->routeExecUrl("adminmaster_exec_setRole_route"); ?>" class="applive-setRole_route">
                    <input type="hidden" name="route" value="<?php echo $route; ?>"/>
                    <input type="hidden" name="app" value="<?php echo $value[0]; ?>"/>
                    <input type="hidden" name="file" value="<?php echo $value[1]; ?>"/>
                    <input type="hidden" name="type" value="<?php echo $value[2]; ?>"/>
                    <?php $c->view("adminmaster","roles-list","roles-list",["id"=>$route,"checked"=>((isset($value[3]))?$value[3]:[])]); ?>
                    <input type="submit" class="btn btn-xs pull-right bt-primary showOnChange" value="save">
                    </form>
                    </td>
                    <td class="text-center">
                        <?php $dir = $c->dirRoute($route); ?>
                        <?php echo "<a href='".WEB_FILE_EDITOR."&file=".$dir."' target='_blank'><i class='fa fa-code '></i></a>"; ?>
                    </td>
                </tr>
                
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <div class="portlet-footer">
    	<?php $c->view("adminmaster","form-route-create"); ?>
    </div>
</div>