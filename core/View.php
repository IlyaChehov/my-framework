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
        extract($data);
        $contentFilePath = DIR_VIEW . "/{$content}.php";

        if (!file_exists($contentFilePath)) {
            return 'Not file View';
        }

        ob_start();
        require $contentFilePath;
        $this->content = ob_get_clean();

        $layout = $layout ?? $this->layout;
        $layoutFilePath = DIR_VIEW . "/layouts/{$layout}.php";

        if (!file_exists($layoutFilePath)) {
            return 'Not file Layout';
        }

        require_once $layoutFilePath;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
