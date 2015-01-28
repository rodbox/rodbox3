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

        <?php 
            $autoload->getCss();
            $autoload->getLibCss("codemirror"); 
        ?>

        <!-- END META IOS -->
        <?php 
            $autoload->css(); 
           
        ?>
         <link rel="stylesheet" href="css/appnav.css">

        <link rel="stylesheet" href="css/app-circlemenu.css">
        <link rel="stylesheet" href="css/style.css">

        <title>Appfile</title>
        </head>
        <body id="page" class="<?php uisession(); ?>">
        <?php 
        $menuRight = true;
        include('header.php');
        ?>
        <!-- START CONTENT -->
        <div class="page">
        <?php  include('views/content.php');?>
        </div>
        <!-- END CONTENT -->
        
        <i id="bodyProtect" class="icomoon-warning2 "></i>

        <?php 
            $autoload->getJs();
            $autoload->getLibJs("codemirror");
        ?>


 
        <script src="js/jquery-app.js"></script>

        <script src="js/appnav.js"></script>
        <script src="js/app.js"></script>
 
    </body>
</html>