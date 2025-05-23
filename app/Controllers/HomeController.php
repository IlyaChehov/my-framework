<?php

namespace My\Framework\App\Controllers;

class HomeController
{
    public function index(): ?string
    {
        return view()->render('index', ['pageTitle' => 'Main | Test', 'text' => 'main']);
    }

    public function contacts(): ?string
    {
        return view()->render('contacts', ['pageTitle' => 'Contacts | Test', 'text' => 'contacts'], 'test');
    }
}
