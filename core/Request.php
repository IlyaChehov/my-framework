<?php

namespace My\Framework\Core;

class Request
{
    public function __construct(
        private string $uri
    ) {
        $this->uri = urldecode($this->uri);
    }

    public function getMethod(): string
    {
        return strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
    }

    public function isGet(): bool
    {
        return $this->getMethod() === 'GET';
    }

    public function isPost(): bool
    {
        return $this->getMethod() === 'POST';
    }

    public function getInputValue(string $key, mixed $default = null): mixed
    {
        $value = $_GET[$key] ?? $_POST[$key] ?? $default;
        return trim($value);
    }

    public function getAllFields(array $validFields): array
    {
        return $this->removeInvalidFields($validFields);
    }

    private function removeInvalidFields(array $validFields): array
    {
        $all = array_merge($_GET, $_POST);
        $fieldsFiltered = array_filter($all, function ($field) use ($validFields) {
            return in_array($field, $validFields);
        }, ARRAY_FILTER_USE_KEY);

        return array_map(fn($el) => trim($el), $fieldsFiltered);
    }

    public function getPath(): string
    {
        return $this->removeQueryString();
    }

    private function removeQueryString(): string
    {
        if (!$this->uri) {
            return '/';
        }

        $uriToArray = explode('?', $this->uri);
        $path = trim($uriToArray[0], '/');
        return "/{$path}";
    }
}
