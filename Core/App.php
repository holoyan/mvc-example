<?php

namespace Core;

class App
{
    use Make;

    public function handle(Request $request)
    {
        $route = require_once ROOT . DIRECTORY_SEPARATOR . "routes/web.php";
        $route->direct(
            $request->method(),
            $request->uri()
        );
    }
}