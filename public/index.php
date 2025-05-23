<?php

use My\Framework\Core\Application;

require_once '../vendor/autoload.php';

$app = new Application();
$routes = require DIR_CONFIG . '/routes.php';
$routes($app->getRouter());
app()->run();
