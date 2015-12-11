#!/usr/bin/env php
<?php

// TODO check if still works without bootstrap

use Loo\Task\DatabaseSetup;
use Symfony\Component\Console\Application;

$application = new Application();
// TODO add task for set up basic App
$application->add(new DatabaseSetup());
$application->run();
