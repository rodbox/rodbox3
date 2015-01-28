<?php  include('../include.php');?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        
        <!-- START META IOS -->
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black" />
        <meta name="apple-mobile-web-app-capable" content="no" />

        <link rel="apple-touch-icon" href="images/ios_icon.png"/>
        <link rel="apple-touch-startup-image" href="images/ios_startup.png" />
        <!-- END META IOS -->

        <!-- START CSS AUTOLOAD -->
        <?php 
            $autoload->getCss(); 
            $autoload->css();
        ?>
        <!-- END CSS AUTOLOAD -->
        
        <link rel="stylesheet" href="css/style.css">

        <title>[APP TITLE]</title>
    </head>
    <body>
        <?php  include('header.php');?>
        <!-- START CONTENT -->
        <div class="page">
        <?php  include('views/content.php');?>
        </div>
        <!-- END CONTENT -->

        <!-- START JS AUTOLOAD -->
        <?php $autoload->getJs(); ?>
        <!-- END JS AUTOLOAD -->

        <script src="js/app.js"></script>
    </body>
</html>