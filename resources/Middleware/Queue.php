<?php

namespace Resources\Middleware;

use Exception;

final class Queue
{
    private static array $map = [];
    private static array $default = [];
    private array $middlewares = [];
    private object $controller;
    private array $controllerArgs = [];

    public function __construct(array $middlewares, object $controller, array $controllerArgs)
    {
        $this->middlewares = array_merge(self::$default, $middlewares);
        $this->controller = $controller;
        $this->controllerArgs = $controllerArgs;
    }

    public static function definirMapa($map)
    {
        self::$map = $map;
    }

    public static function definirPadrao($default)
    {
        self::$default = $default;
    }

    public function proximo(object $request): object
    {
        if (empty($this->middlewares)) return call_user_func_array($this->controller, $this->controllerArgs);

        $middleware = array_shift($this->middlewares);
        if (!isset(self::$map[$middleware])) {
            throw new Exception('Problemas ao processar o middleware da requisição!', 500);
        }

        $queue = $this;
        $next = function ($request) use ($queue) {
            return $queue->proximo($request);
        };
        return (new self::$map[$middleware])->handle($request, $next);
    }
}
