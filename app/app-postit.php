<?php
session_start();

require_once("../app-controller/app-config.php");
require_once("../app-controller/app-controller.php");

extract($_POST);
extract($_GET);


$d = app::model($app,$model);
echo $d;
?>