<?php include('../include.php');?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('meta/config.php');?>
        
        <meta charset="UTF-8">
        <!-- START META IOS -->
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black" />
        <meta name="apple-mobile-web-app-capable" content="no" />
        <link rel="apple-touch-icon" href="images/ios_icon.png"/>
        <link rel="apple-touch-startup-image" href="images/ios_startup.png" />
        <!-- END META IOS -->

        <?php 
            $autoload->getCss(); 
            $autoload->getLibCss("codemirror"); 
            $autoload->css(); 
        ?>


        <!-- end Code mirror css -->
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/app-circlemenu.css">
        <title>DocMaker</title>
    </head>
    <body><?php  include('header.php');?>
            <!-- START CONTENT -->
            <div class="page"><?php include('views/content.php');?></div>
            <!-- END CONTENT -->
            <?php 
                $autoload->getJs();
                $autoload->getLibJs("codemirror");

             ?>

            <script src="js/app-codemirror.js"></script>
            <script src="js/app.js"></script>
    </body>
</html>