<!-- START NAVBAR -->
<nav class="navbar-default navbar navbar-fixed-top bg-2">
    <!-- START TOGGLE FOR MOBILE -->
    <div class="container-fluid">
        <!-- START TOGGLE FOR MOBILE -->
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
        </div>
        <!-- END TOGGLE FOR MOBILE -->
        <!-- Collect the nav links, forms, and other content for toggling -->
        <!-- START NAVBAR LEFT -->
        <div class="collapse navbar-collapse ">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle big strong c-4" href="#">Rodbox <span class="caret"></span></a>
                    <?php  include('../menu.html');?>
                </li>
            </ul>
            <!-- END NAVBAR LEFT -->
            <!-- START NAVBAR RIGHT -->
            <ul class="nav navbar-nav navbar-right pull-right">
                <?php  (isset($menuRight)&&$menuRight)?include('menu-right.php'):"";?>
            </ul>
            <!-- END NAVBAR RIGHT -->
        </div>
        <!-- END NAVBAR-COLLAPSE  -->
    </div>
    <!-- END CONTAINER-FLUID -->
</nav>
<!-- END NAVBAR -->