<?php

declare(strict_types=1);

namespace Resources;

class Request
{
    private object $router;
    private string $httpMethod;
    private string $uri;
    private array $queryParams = [];
    private array $postVars = [];
    private array $headers = [];

    public function __construct($router)
    {
        $this->router = $router;
        $this->queryParams = $_GET ?? [];
        $this->postVars = $_POST ?? [];
        $this->headers = getallheaders();
        $this->httpMethod = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->setUri();
    }

    private function setUri(): void
    {
        $this->uri = $_SERVER['REQUEST_URI'] ?? '';
        $xUri = explode('?', $this->uri);
        $this->uri = $xUri[0];
    }

    public function obterRota(): object
    {
        return $this->router;
    }

    public function getHttpMethod(): string
    {
        return $this->httpMethod;
    }

    public function obterUri(): string
    {
        return $this->uri;
    }

    public function obterCabecalhos(): array
    {
        return $this->headers;
    }

    public function getQueryParams(): array
    {
        return $this->queryParams;
    }

    public function getPostVars(): array
    {
        return $this->postVars;
    }
}
