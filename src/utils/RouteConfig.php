<?php

namespace CooperTest\Utils;

use CooperTest\Utils\Mensagens;

class RouteConfig
{
    private $routes = [];

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    private function isMatchingRoute(array $route, string $request, string $method)
    {
        return $route['endpoint'] === $request && $route['method'] === $method;
    }

    private function sendNotFound(string $message)
    {
        http_response_code(404);
        echo $message;
    }

    public function getRequestedRoute()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        return  str_replace($_ENV['NAME_PASTA'], '', rtrim($uri, '/'));
    }

    public function resolve()
    {
        $requestedRoute = $this->getRequestedRoute();

        $requestedMethod = $_SERVER['REQUEST_METHOD']; 

        foreach ($this->routes as $route) {
            if ($this->isMatchingRoute($route, $requestedRoute, $requestedMethod)) {

                $controllerClass = $route['class'][0];

                $method = $route['class'][1];

                if (class_exists($controllerClass) && method_exists($controllerClass, $method)) {
                    $controller = new $controllerClass();
                    call_user_func([$controller, $method]);
                    return;
                }

                return $this->sendNotFound(Mensagens::MENSAGEM_ARQUIVO_NAO_ENCONTRADO);
            }
        }
        
        $this->sendNotFound(Mensagens::MENSAGEM_ERRO_ROUTER_NAO_ECONTRADA);
    }
}
