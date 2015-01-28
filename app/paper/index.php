<?php  include('../include.php');?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <!-- $autoload est instancier dans le include -->
        
        <!-- START META IOS -->
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black" />
        <meta name="apple-mobile-web-app-capable" content="no" />

     
        <!-- END META IOS -->

        <!-- START CSS AUTOLOAD -->
        <?php 
            $autoload->getCss(); 
            $autoload->css(); // pour la demo
            $autoload->getLibCss("codemirror");
        ?>
        <!-- END CSS AUTOLOAD -->
        
        <link rel="stylesheet" href="css/style.css">

        <title>PaperJS</title>
    </head>
    <body id="page">
        <?php 
        $menuRight = true;
        include('header.php');?>
        <!-- START CONTENT -->
        <div class="page">
        <?php  include('views/content.php');?>
        </div>
        <!-- END CONTENT -->

        <!-- START JS AUTOLOAD -->
        <?php $autoload->getJs(); ?>
        <?php $autoload->getLibJs("paperjs"); ?>
        <?php $autoload->getLibJs("codemirror"); ?>
        <!-- END JS AUTOLOAD -->
       
        <script src="js/app.js"></script>
        <script src="js/app-codemirror.js"></script>
    </body>
</html>
