<?php

use JetBrains\PhpStorm\NoReturn;

function app(): \My\Framework\Core\Application
{
    return \My\Framework\Core\Application::getApp();
}

function view(): \My\Framework\Core\View
{
    return app()->getView();
}

function dump(array|string $data): void
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

function dumpDie(array|string $data): void
{
    dump($data);
    die;
}
