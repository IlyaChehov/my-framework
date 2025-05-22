<?php

namespace My\Framework\Core;

class Router
{
    private array $routers = [];
    private array $params = [];

    public function __construct(
        private Request $request,
        private Response $response
    ) {
    }

    public function add(string $path, callable|array $action, string ...$method): self
    {
        $path = trim($path, '/');
        $method = array_map(fn($el) => strtoupper($el), $method);

        $this->routers[] = [
            'path' => "/{$path}",
            'action' => $action,
            'method' => $method,
            'middleware' => null
        ];

        return $this;
    }

    public function get(string $path, callable|array $action): self
    {
        return $this->add($path, $action, 'GET');
    }

    public function post(string $path, callable|array $action): self
    {
        return $this->add($path, $action, 'POST');
    }

    private function matchRoute(string $path): mixed
    {
        foreach ($this->routers as $router) {
            if (
                preg_match("#^{$router['path']}$#", $path, $matches)
                &&
                in_array($this->request->getMethod(), $router['method'])
            ) {
                foreach ($matches as $k => $v) {
                    if (is_string($k)) {
                        $this->params[$k] = $v;
                    }
                }
                return $router;
            }
        }

        return false;
    }

    public function dispatch(): mixed
    {
        $path = $this->request->getPath();
        $route = $this->matchRoute($path);

        if ($route === false) {
            $this->response->setResponseCode();
            die('Route not found');
        }

        if (is_array($route['action'])) {
            $route['action'][0] = new $route['action'][0];
        }

        return call_user_func($route['action']);
    }
}
