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

        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" >
        <link rel="stylesheet" href="http://demo.rodbox.fr/appdemo/css/style.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/canvas.css">

        <title>[APP TITLE]</title>
    </head>
    <body>
        <?php  include('header.php');?>
        <!-- START CONTENT -->
        <?php  include('views/canvas.php');?>
        <!-- END CONTENT -->

        <!-- START JS STATIC -->
        <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
        <script src="http://static.rodbox.fr/mobile-events/jquery.mobile-events.min.js"></script>
        <script src="http://static.rodbox.fr/appmobile/jquery-appmobile.js"></script>
        <!-- END JS STATIC -->

        <script src="js/canvas.js"></script>
    </body>
</html>