<?php

declare(strict_types=1);

namespace Lib\Db;

use Lib\Config;
use PDO;
use PDOException;
use RuntimeException;

class Database
{
    private static PDO|null $pdo = null;

    public static function getConnection(): PDO
    {
        if(self::$pdo instanceof PDO) {
            return self::$pdo;
        }

        $dsn = Config::get('DB_DRIVER')
            . ':host=' . Config::get('DB_HOST')
            . ';dbname=' . Config::get('DB_DATABASE')
            . ';charset=utf8';

        try {
            self::$pdo = new PDO($dsn, Config::get('DB_USERNAME'), Config::get('DB_PASSWORD'));
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new RuntimeException('Database connection failed: ' . $e->getMessage());
        }

        return self::$pdo;
    }
}