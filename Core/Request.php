<?php

namespace Core;

class Request
{
    use Make;

    private $server;

    public function __construct()
    {
        $this->server = $_SERVER;
    }

    public function uri()
    {
        return trim($this->server['PATH_INFO'] ?? '', '/');
    }

    public function method()
    {
        return $this->server['REQUEST_METHOD'];
    }

    public function all()
    {
        switch ($this->method()) {
            case 'GET':
                return $_GET;
            case 'POST':
                return array_merge($_POST, $_FILES);
            default :
                throw new \Exception('Unsupported method');
        }
    }
}
