<?php

function app(): \My\Framework\Core\Application
{
    return \My\Framework\Core\Application::getApp();
}

function view(): \My\Framework\Core\View
{
    return app()->getView();
}
