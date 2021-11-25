<?php

define('ROOT', dirname(__DIR__));

require_once ROOT . "/Core/bootstrap.php";

\Core\App::make()->handle(
    \Core\Request::make()
);
