<?php 
    include('../bootstrap.php');
    include('../app-controller/app-controller.php');

    $c = new controller();
    $autoload = new autoload($c->app);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <?php $autoload->getCss();?>
        <title> <?php $c->title(); ?> </title>
        </head>
        <body id="page" class="<?php //uisession(); ?>">
        <?php if (isset($_GET["intro"])&&$_GET["intro"]=="true"): ?>
            <div id="fullmsg" class="fullmsg-container open outro"><p><?php echo $_SESSION["fullmsg"]; ?></p></div>
        <?php endif ?>
        <?php 
        	$c->header();
        ?>
        <!-- START CONTENT -->
        <div class="page">
            <?php $c->page(); ?>
        </div>
        <!-- END CONTENT -->
               
        <i id="bodyProtect" class="icomoon-warning2 "></i>

        <?php 
            $autoload->getJs();
        ?>

    </body>
</html>