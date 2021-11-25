<?php

function dump(...$items){
    echo "<pre>";
    foreach ($items as $item) {
        print_r($item);
        echo "<br>";
    }
    echo "</pre>";
}

function dd(...$items){
    dump(...$items);
    die();
}

function view($blade, array $vars = [])
{
    extract($vars);

    $blade = str_replace('.', DIRECTORY_SEPARATOR, $blade);
    require_once ROOT . DIRECTORY_SEPARATOR . "resources/views/$blade.blade.php";
}

function redirect($uri)
{
    header("Location: $uri");
}
