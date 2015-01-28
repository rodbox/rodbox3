<?php include('../include.php');?>
<!doctype html>
<html>
    <head>
        <title></title>
        
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black" />
        <link rel="apple-touch-icon" href="images/ios_icon.png"/>
        <link rel="apple-touch-startup-image" href="images/ios_startup.png" />
         <?php 
            $autoload->getCss();
            $autoload->getLibCss("codemirror"); 
            $autoload->css(); 
        ?>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="snippet-color.css">
        
        <link rel="stylesheet" href="plugins/appcaret.css">

    </head>
    <body>
    <?php  include('header.php');?>
    <div id="border-preview" class="page overflow-auto">
            <div  class="col-md-8 col-xs-8 border-right-preview overflow-auto line-9 topno-margh bg-4 colpage">
                <!-- Response -->
                <div class="col-md-8 col-xs-8 page  fixed bg-8 c-7 inline-block v-middle text-center big-5" id="responseContainer">
                    <a href="#" class="bt-close-response absolute right small-2 margh-4 margv-4 c-7 opacity"> <i class="glyphicon glyphicon-remove"></i></a>
                    <a href="#" class="c-7 relative top-3 toggle-response" download=""><i class="glyphicon glyphicon-floppy-disk"></i> <br>Télécharger <br><span class="small-2 opacity" id="filename-response"></span></a>
                </div>
                <!-- end Response -->
                <!-- Editeur -->
                <div class="padh-6 padv-5 line-7 ">
                    <?php include('views/editor.php');?>
                </div>
                <!-- end Editeur -->
            </div>
            <!-- Snippet list -->
            <div id="snippet-list-col" class="col-md-4 col-xs-4 line-9 top bg-8 c-7 no-margh overflow-auto">
                <?php include('views/snippet-list.php');?>
            </div>
            <!-- end Snippet list -->
        </div>

        <?php include('views/modal.php');?>

    <<?php 
            $autoload->getJs();
            $autoload->getLibJs("codemirror");
     ?>
        <script src="http://static.rodbox.fr/getselection/jquery-getselection.js"></script>
      <!-- end static -->
        <script src="plugins/jquery-appcaret.js"></script>
        <script src="plugins/jquery-localsearch.js"></script>
        <script src="plugins/jquery-appkeynav.js"></script>

        <script src="config.js"></script>

     
        <!-- end Code mirror -->
        <script src="jquery-formcache.js"></script>
        <script src="jquery-app.js"></script>
        <script src="app.js"></script>


    </body>
</html>