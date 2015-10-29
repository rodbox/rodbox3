<?php
// cli-config.php
require_once "bootstrap.php";

// $em = GetMyEntityManager();

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);


