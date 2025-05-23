<?php

namespace My\Framework\App\Controllers;

class HomeController
{
    public function index(): ?string
    {
        return view()->render('index', ['pageTitle' => 'WORK!!!!', 'text' => 'QWERTY']);
//        return view()->render('index', ['pageTitle' => 'WORK!!!!', 'text' => 'QWERTY'], 'test');

    }
}
