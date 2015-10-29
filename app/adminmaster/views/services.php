<!-- 
    BEGIN RB PORTLET : title  
    options : 
        .default .inverse pour utiliser les couleurs predefinit
        .portlet-footer-active pour afficher le footer du protlet
        .line-1 2 ou 3 pour definir la hauteur du protlet
-->
<div class="portlet">
    <div class="portlet-title tabbable-line">
        <div class="caption">
            <span class="caption-subject">Services</span> <span class="caption-helper"><?php $c->routeExec("adminmaster_exec_compile_services","Compile","",["class"=>"appliveexec"]) ?>
                <?php $c->help("Compile tout les services des app disponibles vers le kernel.","right"); ?>

            </span>
        </div>
        <div class="actions"><button data-toggle="button" class="btn no-border btn-default btn-xs toggle-portlet-footer" type="button" aria-pressed="false"><i class="fa fa-arrows-v  "></i></button>
            <button data-toggle="button" class="btn no-border btn-default btn-xs toggle-portlet-fullscreen" type="button" aria-pressed="false"><i class="glyphicon glyphicon-resize-full "></i></button></div>
    </div>
    <div class="portlet-body">
        <table class="table table-striped data-table">
            <thead>
                <tr>
                    <th>Service</th>
                    <th>App</th>
                    <th>Controller</th>
                    <th>Method</th>
                    <th>Params</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($d as $key => $value): ?>
                <tr>
                    <td><strong><?php echo $key; ?></strong></td>
                    <td><?php echo $value[0]; ?></td>
                    <td><?php echo $value[1]; ?></td>
                    <td><?php echo $value[2]; ?></td>
                    <td><?php echo (isset($value[3]))?$value[3]:""; ?></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

    </div>
    <div class="portlet-footer">
    <?php $c->view("adminmaster","form-service-create"); ?>
    </div>
</div>
<!-- END RB PORTLET : title -->