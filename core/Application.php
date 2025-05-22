<?php

namespace My\Framework\Core;

class Application
{
    private Request $request;
    private Response $response;
    private Router $router;
    private static Application $app;

    public function __construct(string $uri = null)
    {
        self::$app = $this;
        $uri = $uri ?? $_SERVER['REQUEST_URI'];
        $this->request = new Request($uri);
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
    }

    public static function getApp(): Application
    {
        return self::$app;
    }

    public function run(): void
    {
        echo $this->router->dispatch();
    }

    public function router(): Router
    {
        return $this->router;
    }
}
