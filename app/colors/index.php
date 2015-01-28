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
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" >
        <link rel="stylesheet" href="http://demo.rodbox.fr/appdemo/css/style.css">
        <link rel="stylesheet" href="http://static.rodbox.fr/spectrum/spectrum.css">
        <link rel="stylesheet" href="css/style.css">

        <title>Demo colors</title>
    </head>
    <body class=" bg-2 no-bgi">
        <?php $menuRight=true; include('header.php');?>
        <!-- START CONTENT -->
        <div class="page">
        <?php  include('views/content.php');?>
        </div>
        <!-- END CONTENT -->

        <!-- START JS STATIC -->
        <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
        <script src="http://static.rodbox.fr/mobile-events/jquery.mobile-events.min.js"></script>
        <script src="http://static.rodbox.fr/appmobile/jquery-appmobile.js"></script>
        <!-- END JS STATIC -->

        <!-- START JS STATIC DEMO -->
        <script src="http://static.rodbox.fr/appinfo/jquery-appinfo.js"></script>
        <script src="http://static.rodbox.fr/applive/jquery-appliveform.js"></script>
        <script src="http://static.rodbox.fr/spectrum/spectrum.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
        <!-- END JS STATIC DEMO -->

        <script src="js/jquery-formpng.js"></script>
        <script src="js/app.js"></script>
    </body>
</html>