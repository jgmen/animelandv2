<?php

namespace Alice\Animeland\Core;


/**
 * @method static get(string $route, Callable $callback)
 * @method static post(string $route, Callable $callback)
 * @method static put(string $route, Callable $callback)
 * @method static delete(string $route, Callable $callback)
 * @method static options(string $route, Callable $callback)
 * @method static head(string $route, Callable $callback)
 */

class Ralts {
  public static $halts = false;       // Flag to halt on first match 
  public static $routes = array();    // Array contain all routes
  public static $methods = array();   // Array methods (GET, POST, PUT)
  public static $callbacks = array(); // Array contain all functions
  public static $maps = array();      // Routes with multiples HTTP methods
  public static $patterns = array(
    ':any' => '[^/]',
    ':num' => '[0-9]+',
    ':all' => '.*'
  );
  public static $error_callback;      // Error when none route is found 
  public static $root;                // Adjust root URL
  private static $call; 

  public static function __callStatic($method, $params) {
    $maps = null;
    $uri = strpos($params[0], '/') === 0 ? $params[0] : '/' . $params[0];
    $callback = $params[1];

    array_push(self::$maps, $maps);
    array_push(self::$routes, $uri);
    array_push(self::$methods, strtoupper($method));
    array_push(self::$callbacks, $callback);
  }

  public static function error($callback) {
    self::$error_callback = $callback;
  }

  public static function dispatch() {

    // Get uri and parse it
    $uri = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    $method = $_SERVER['REQUEST_METHOD'];

    $searches = array_keys(static::$patterns);
    $replaces = array_values(static::$patterns);

    $found_route = false;

    // Check if route is defined
    if (in_array($uri, self::$routes)) {
      $route_pos = array_keys(self::$routes, $uri);

      foreach ($route_pos as $route) {
        if (self::$methods[$route] == $method) {

          $found_route = true;

          // call closure
          self::$call = self::$callbacks[$route];
          call_user_func(self::$call);

          if (self::$halts) return;
        }
      }
    } else {
      // check if is defined with regex
      $pos = 0;
      foreach (self::$routes as $route) {
        if (strpos($route, ':') !== false) {
          $route = str_replace($searches, $replaces, $route);
        }

        if (preg_match('#^' . $route . '$#', $uri, $matched)) {
          if (self::$methods[$pos] == $method) {
            $found_route = true;
            array_shift($matched);

            // call closure
            self::$call = self::$callbacks[$pos];
            call_user_func(self::$call, $matched[0]);

            if (self::$halts) return;
          }
        }
        $pos ++;
      }
    }

    // Run error callback if not found

    if ($found_route == false) {
      if (!self::$error_callback) {
        self::$error_callback = function () {
          header($_SERVER['SERVER_PROTOCOL']. " 404 Not Found");
          echo '404';
          return;
        };
      }
      call_user_func(self::$error_callback);
    }

  }

}
