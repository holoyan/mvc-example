<?php

namespace Core;

trait Make
{
    public static function make(...$params)
    {
        return new self(...$params);
    }
}