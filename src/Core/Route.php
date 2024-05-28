<?php

namespace Alice\Animeland\Core;

class Route {
  private $method;
  private $path;
  private $callback;

  public function __construct($method, $path, $callback) {
    $this->method = $method;
    $this->path = $path;
    $this->callback = $callback;
  }

  public function getPath() {
    return $this->path;
  }

  public function getMethod() {
    return $this->method;
  }

  public function getCallback() {
    return $this->callback;
  }
}
