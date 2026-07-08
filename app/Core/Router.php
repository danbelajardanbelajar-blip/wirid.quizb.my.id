<?php
namespace App\Core;

class Router {
    private $routes = [];

    public function add($method, $path, $controller, $action) {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'controller' => $controller,
            'action' => $action
        ];
    }

    public function dispatch($method, $uri) {
        // Strip query string
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rtrim($uri, '/');
        if ($uri === '') $uri = '/';

        $method = strtoupper($method);

        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['path'] === $uri) {
                $controllerName = "App\\Controllers\\" . $route['controller'];
                if (class_exists($controllerName)) {
                    $controller = new $controllerName();
                    $action = $route['action'];
                    if (method_exists($controller, $action)) {
                        return $controller->$action();
                    }
                }
            }
        }

        // SPA Catch-all fallback: arahkan semua rute non-API ke index SPA
        if (strpos($uri, '/api') !== 0) {
            $controllerName = "App\\Controllers\\PageController";
            if (class_exists($controllerName)) {
                $controller = new $controllerName();
                return $controller->index();
            }
        }

        // 404 untuk API
        http_response_code(404);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(["ok" => false, "error" => "Endpoint API tidak ditemukan ($uri)"]);
    }
}
