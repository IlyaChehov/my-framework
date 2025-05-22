<?php

namespace My\Framework\Core;

class View
{
    private string $layout;
    private string $content = '';

    public function __construct(string $layout)
    {
        $this->layout = $layout;
    }

    public function render(string $content, array $data = [], $layout = null)
    {
    }
}
