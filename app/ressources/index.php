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
 <?php 
            $autoload->getCss();
 
            $autoload->css(); 
            $autoload->css("ressources","range"); 
        ?>

        
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/range.css">

        <title>Ressources</title>
    </head>
    <body id="page">
        <?php  include('header.php');?>
        <!-- START CONTENT -->
        <div class="page">
        <?php  include('views/content.php');?>
        </div>
        <!-- END CONTENT -->

<?php $autoload->getJs(); ?>
<?php $autoload->getLibJs("plupload"); ?>

        <script src="js/app.js"></script>

    </body>
</html>