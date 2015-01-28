<?php include('../include.php');?>
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


     <?php 
            $autoload->getCss(); 
            $autoload->css(); 
        ?> 

        <link rel="stylesheet" href="css/style.css">


        <title>Tool</title>
    </head>
    <body>
        <?php $menuRight =true;  ?>
        <?php  include('header.php');?>
        <!-- START CONTENT -->
        <?php  include('views/icon-list.php');?>
          <!-- END CONTENT -->


        <?php 
            $autoload->getJs();
        ?>


        <script src="js/app-localsearch.js"></script>
        <script src="js/app.js"></script>
    </body>
</html>