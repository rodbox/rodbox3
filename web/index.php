<?php 
session_start();
    include('../app-controller/app-controller.php');

    $c = new controller();
    set_error_handler('errorManager');

?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <?php $c->autoload->getCss();?>
        <title> <?php $c->title(); ?> </title>
        </head>
        <body id="page" class="">
        <ul class='flash-container'>
        <?php $c->getFlash(); ?>
        </ul>
        <?php $c->header(); ?>

        <!-- START CONTENT -->
        <div class="page cover bgp bg-fixed" style="background-image: url(<?php echo WEB_USERS."/1/bg-3.jpg"; ?>);">
            <?php $c->page(); ?>
        </div>
        <!-- END CONTENT -->
        <!-- START SIDEBARD -->
            <?php $c->quicksidebar(); ?>
        <!-- END SIDEBARD -->
        <!-- MODAL Include -->
        <?php $c->view("app","bootstrap/modal"); ?>
        <?php $c->view("app","footer"); ?>
        <i id="bodyProtect" class="icomoon-warning2 "></i>
        <?php $c->autoload->getJs(); ?>
    </body>
</html>