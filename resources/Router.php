<?php

declare(strict_types=1);

namespace Resources;

use Closure;
use Exception;
use ReflectionFunction;
use Resources\Middleware\Queue;

class Router
{
    private string $url = '';
    private string $prefix = '';
    private array $routes = [];
    private object $request;

    /** Custom messages */
    private string $notFound = '<div style="text-align:center">A URL não pode ser encontrada!</div>';
    private string $unprocessed = '<div style="text-align:center">A URL não pode ser processada!</div>';
    private string $notAllowed = '<div style="text-align:center">Método não permitido!</div>';

    private function definirPrefixo()
    {
        $parseUrl = parse_url($this->url);
        $this->prefix = $parseUrl['path'] ?? '';
    }

    private function adicionarRota($method, $route, $params = [])
    {
        foreach ($params as $key => $value) {
            if ($value instanceof Closure) {
                $params['controller'] = $value;
                unset($params[$key]);
                continue;
            }
        }

        $params['middlewares'] = $params['middlewares'] ?? [];
        $params['variables'] = [];
        $patternVariable = '/{(.*?)}/';
        if (preg_match_all($patternVariable, $route, $matches)) {
            $route = preg_replace($patternVariable, '(.*?)', $route);
            $params['variables'] = $matches[1];
        }

        $patternRoute = '/^' . str_replace('/', '\/', $route) . '$/';
        $this->routes[$patternRoute][$method] = $params;
    }

    private function obterUri()
    {
        $uri = $this->request->obterUri();
        $xUri = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];
        return end($xUri);
    }

    private function obterRota()
    {
        $uri = $this->obterUri();
        $httpMethod = $this->request->getHttpMethod();

        foreach ($this->routes as $patternRoute => $methods) {
            if (preg_match($patternRoute, $uri, $matches)) {
                if (isset($methods[$httpMethod])) {
                    unset($matches[0]);
                    $keys = $methods[$httpMethod]['variables'];
                    $methods[$httpMethod]['variables'] = array_combine($keys, $matches);
                    $methods[$httpMethod]['variables']['request'] = $this->request;
                    return $methods[$httpMethod];
                }
                throw new Exception($this->notAllowed, 405);
            }
        }
        throw new Exception($this->notFound, 404);
    }

    public function __construct($url)
    {
        $this->request = new Request($this);
        $this->url = $url;
        $this->definirPrefixo();
    }

    public function get($route, $params = [])
    {
        return $this->adicionarRota('GET', $route, $params);
    }

    public function post($route, $params = [])
    {
        return $this->adicionarRota('POST', $route, $params);
    }

    public function put($route, $params = [])
    {
        return $this->adicionarRota('PUT', $route, $params);
    }

    public function delete($route, $params = [])
    {
        return $this->adicionarRota('DELETE', $route, $params);
    }

    public function run()
    {
        try {
            $route = $this->obterRota();
            if (!isset($route['controller'])) {
                throw new Exception($this->unprocessed, 500);
            }

            $args = [];
            $reflection = new ReflectionFunction($route['controller']);
            foreach ($reflection->getParameters() as $parameter) {
                $name = $parameter->getName();
                $args[$name] = $route['variables'][$name] ?? '';
            }

            return (new Queue($route['middlewares'], $route['controller'], $args))->proximo($this->request);
        } catch (Exception $e) {
            return new Response($e->getCode(), $e->getMessage());
        }
    }

    public function obterUrlAtual(): string
    {
        return $this->url . $this->obterUri();
    }

    public function redirecionar($route): void
    {
        $prc = ['\\', '\\\\', '/', '//'];
        $urlSis = (str_replace($prc, '/', ($this->url . $route)));
        $newUrl = str_replace(':/', '://', $urlSis);
        header('Location:' . $newUrl);
        exit();
    }
}
