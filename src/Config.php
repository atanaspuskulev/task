<?php

declare(strict_types=1);

namespace Lib;

use Dotenv\Dotenv;

class Config
{
    private static array $config = [];

    public static function load(string $path): void
    {
        $dotenv = Dotenv::createImmutable($path);
        $dotenv->load();

        self::$config = $_ENV;
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        return self::$config[$key] ?? $default;
    }
}