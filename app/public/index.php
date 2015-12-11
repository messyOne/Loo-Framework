<?php

use Loo\Core\MasterFactory;
use Loo\Core\Loo;
use Loo\Http\Request;

$url = isset($_GET['url']) ? $_GET['url'] : '';
unset($_GET['url']);

include_once(dirname(__DIR__).'/private/bootstrap.php');

$factory = new MasterFactory();

$app = new Loo($factory);
$app->run(new Request($url));
