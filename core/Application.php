<?php

namespace My\Framework\Core;

use JetBrains\PhpStorm\NoReturn;

class Application
{
    private Request $request;
    private Response $response;
    private Router $router;

    private View $view;
    private static Application $app;

    public function __construct(string $uri = null)
    {
        self::$app = $this;
        $uri = $uri ?? $_SERVER['REQUEST_URI'];
        $this->request = new Request($uri);
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->view = new View('default');
    }

    public static function getApp(): Application
    {
        return self::$app;
    }

    public function run(): void
    {
        echo $this->router->dispatch();
    }

    public function getRouter(): Router
    {
        return $this->router;
    }

    public function getView(): View
    {
        return $this->view;
    }

    #[NoReturn] public function abort(int $code = 404, string $errorMessage = '', string|false $layout = null): void
    {
        $this->response->setResponseCode($code);
        $this->view->render("error/{$code}", ['message' => $errorMessage], $layout);
        die;
    }
}
