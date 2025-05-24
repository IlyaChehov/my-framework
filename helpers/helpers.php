<?php

use JetBrains\PhpStorm\NoReturn;

function app(): \My\Framework\Core\Application
{
    return \My\Framework\Core\Application::getApp();
}

function dump(array|string $data): void
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

#[NoReturn] function dumpDie(array|string $data): void
{
    dump($data);
    die;
}
