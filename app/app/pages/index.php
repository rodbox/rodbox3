<!-- BEGIN ROW  -->
<div class="row top-1 relative">
    <!-- BEGIN COL : col-md-4 col-lg-4  -->
    <div class="col-md-4 col-lg-4 col-md-offset-1 col-lg-offset-1 relative">
        <!-- BEGIN RB PORTLET : title
            options :
                .default .inverse pour utiliser les couleurs predefinit
                .portlet-footer-active pour afficher le footer du protlet
                .line-1 2 ou 3 pour definir la hauteur du protlet
        -->
        <div class="portlet calendar ">
            <div class="portlet-title tabbable-line">
                <div class="caption">
                    <i class="icon-icon "></i>
                    <span class="caption-subject   bold uppercase"></span> <span class="caption-helper"></span>
                </div>
                <div class="actions"></div>
            </div>
            <div class="portlet-body">
                <?php
                $c->view("app", "calendar"); ?>
            </div>
            <div class="portlet-footer">
            </div>
        </div>
        <!-- END RB PORTLET : title -->

    </div>
    <!-- END COL : col-md-4 col-lg-4  -->
    <?php
    if ($c->isRole("MASTER")): ?>
    <!-- BEGIN COL : col-md-4 col-lg-4  -->
    <div class="col-md-4 col-lg-4 ">
    <!-- BEGIN RB PORTLET : Resume  
        options : 
            .default .inverse pour utiliser les couleurs predefinit
            .portlet-footer-active pour afficher le footer du protlet
            .line-1 2 ou 3 pour definir la hauteur du protlet
    -->
    <div class="portlet default ">
        <div class="portlet-title tabbable-line">
            <div class="caption">
                <i class="icon-icon "></i>
                <span class="caption-subject   bold uppercase">Resume</span> <span class="caption-helper"></span>
            </div>
            <div class="actions"></div>
        </div>
        <div class="portlet-body">
    		 <?php $c->view("app", "content"); ?>
        </div>
        <div class="portlet-footer">
        </div>
    </div>
    <!-- END RB PORTLET : Resume -->
       
    </div>
    <!-- END COL : col-md-4 col-lg-4  -->
    <!-- END ROW  -->
    <?php
    endif;
?></div>