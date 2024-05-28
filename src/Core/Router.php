<?php

namespace Alice\Animeland\Core;

class Router {
    /** @var Route[] */
private array $routes = [];

  public function add(string $method, string $path, callable $callback): void {
    $this->routes[] = new Route($method, $path, $callback);
  }

  public function dispatch(string $requestUri, string $requestMethod) {
    foreach ($this->routes as $route) {
      if ($route->getMethod() === $requestMethod && preg_match("@^" . $route->getPath() . "$@", $requestUri, $matches)) {
          array_shift($matches); // Remove o primeiro item que é a rota completa
          return call_user_func_array($route->getCallback(), $matches);
      }
    }
    http_response_code(404);
    echo json_encode(['error' => 'Route not found']);
  }
}
