<?php
use Loo\Core\MasterFactory;
use Loo\Data\Settings;

// TODO add autoloader

require_once 'constants.php';
require_once '../../src/Core/Loo.php';

$factory = new MasterFactory();
Settings::setConfig($factory->getDataFactory()->getConfig());
Settings::setErrorHandling();
Settings::setPhpSettings();
