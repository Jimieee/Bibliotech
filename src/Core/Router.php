<?php
namespace App\Core;
class Router {
    private array $routes = [];
    public function get(string $path, callable $h): void { $this->routes['GET'][$path] = $h; }
    public function post(string $path, callable $h): void { $this->routes['POST'][$path] = $h; }

    public function dispatch(): void {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
        $handler = $this->routes[$method][$uri] ?? null;
        if (!$handler) { http_response_code(404); echo "404 Not Found"; return; }
        echo $handler();
    }
}
