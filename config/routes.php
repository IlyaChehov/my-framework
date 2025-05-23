<?php

use My\Framework\Core\Router;

return function (Router $router) {
    $router->get('/', [\My\Framework\App\Controllers\HomeController::class, 'index']);
    $router->get('contacts', [\My\Framework\App\Controllers\HomeController::class, 'contacts']);

};
