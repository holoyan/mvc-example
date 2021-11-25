<?php

namespace Core;

class Route
{
    private $routes = [];

    public function get(string $uri, array $controller)
    {
        $this->routes['get.' . trim($uri, '/')] = $controller;
    }

    public function post(string $uri, array $controller)
    {
        $this->routes['post.' . trim($uri, '/')] = $controller;
    }

    public function direct(string $method, string $uri)
    {
        $strKey = strtolower($method) . '.' . $uri;

        if (array_key_exists($strKey, $this->routes)) {
            $Class = $this->routes[$strKey][0];
            $method = $this->routes[$strKey][1];
            $obj = new $Class();
            $obj->{$method}();
            return;
        } else {
            foreach ($this->routes as $route => $controllers) {
                $r = str_replace('/', '\/', $route);
                $r = '/^' . preg_replace('/\{.*?\}/', '(\w+)\/?', $r) . '$/';
                preg_match_all(
                    $r,
                    strtolower($method) . '.' . $uri,
                    $match,
                    PREG_SET_ORDER
                );

                if (count($match) > 0 && count($match[0]) > 0) {
                    $Class = $controllers[0];
                    $method = $controllers[1];
                    $obj = new $Class();
                    array_shift($match[0]);
                    $obj->{$method}(...$match[0]);
                    return;
                }
            }

            if (
            file_exists(
                ROOT . DIRECTORY_SEPARATOR . "resources/views/404.blade.php"
            )
            ) {
                return view('404');
            } else {
                throw new \Exception('Route not found');
            }
        }
    }

}