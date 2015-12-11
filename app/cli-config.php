#!/usr/bin/env php
<?php
include_once('private/bootstrap.php');

$factory = new \Loo\Database\DatabaseFactory();
$entityManager = $factory->getEntityManager();

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);
