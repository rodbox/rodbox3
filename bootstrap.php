<?php
// bootstrap.php
require_once "app-controller/app-controller.php";



use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;


$app = ["ressources","user"];


$paths = [];
foreach ($app as $key => $value) {
	$paths[] = __DIR__."/app/".$value."/entity";
}


$isDevMode = false;

// the connection configuration
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => 'root',
    'dbname'   => 'rodbox3',
);

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);

