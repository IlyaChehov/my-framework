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
        $contentFileName = DIR_VIEW . "/{$content}.php";

        if (!file_exists($contentFileName)) {
            return 'Not file View';
        }

        ob_start();
        require $contentFileName;
        $this->content = ob_get_clean();

        $layout = $layout ?? $this->layout;
        $layoutFileName = DIR_VIEW . "/layouts/{$layout}.php";

        if (!file_exists($layoutFileName)) {
            return 'Not file Layout';
        }

        require_once $layoutFileName;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
