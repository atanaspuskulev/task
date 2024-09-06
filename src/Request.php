<?php

declare(strict_types=1);

namespace Lib;

class Request
{
    public static function get(string $key, mixed $default = null): mixed
    {
        return $_REQUEST[$key] ?? $default;
    }
}