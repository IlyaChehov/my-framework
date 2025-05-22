<?php

use My\Framework\Core\Application;

require_once '../vendor/autoload.php';

require_once '../config/config.php';
$app = new Application();
require_once DIR_CONFIG . '/routes.php';
require_once DIR_HELPERS . '/helpers.php';
app()->run();
