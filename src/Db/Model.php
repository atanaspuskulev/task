<?php

declare(strict_types=1);

namespace Lib\Db;

use Lib\Db\Helpers\Filtering;
use PDO;

abstract class Model
{
    protected static PDO $pdo;
    protected static string $table;

    abstract protected function getTable(): string;

    public static function create(array $data): int
    {
        static::boot();

        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));

        $sql = "INSERT INTO " . static::$table . " ({$columns}) VALUES ({$placeholders})";
        $stmt = static::$pdo->prepare($sql);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        $stmt->execute();
        return (int) static::$pdo->lastInsertId();
    }

    public static function delete(int $id): bool
    {
        static::boot();

        $sql = "DELETE FROM " . static::$table ." WHERE id = :id";
        $stmt = static::$pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    public static function update(int $id, array $data): bool
    {
        static::boot();

        $set = '';
        foreach ($data as $key => $value) {
            $set .= "$key = :$key, ";
        }
        $set = rtrim($set, ', ');

        $sql = "UPDATE " . static::$table . " SET $set WHERE id = :id";
        $stmt = static::$pdo->prepare($sql);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        $stmt->bindValue(':id', $id);

        return $stmt->execute();
    }

    public static function get(
        array $filters = [],
        bool $usePagination = false,
        int $currentPage = null,
        int $perPage = 10,
        array $orderBy = []
    ): array
    {
        static::boot();

        $filterClauses = [];
        $currentPage = $currentPage !== null && $currentPage > 0 ? (int)$currentPage : 1;
        $perPage = $perPage > 0 ? (int)$perPage : 10;

        $sql = "SELECT * FROM " . static::$table;

        if (!empty($filters)) {
            $filterClauses = Filtering::getFilterArray($filters);
            $sql .= " WHERE " . implode(' AND ', $filterClauses);
        }

        if (!empty($orderBy)) {
            $orderByClauses = [];
            foreach ($orderBy as $column => $direction) {
                $direction = strtoupper($direction) === 'ASC' ? 'ASC' : 'DESC';
                if (preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $column)) {
                    $orderByClauses[] = "$column $direction";
                }
            }
            $sql .= " ORDER BY " . implode(', ', $orderByClauses);
        }

        $stmt = static::$pdo->prepare($sql);
        foreach ($filters as $column => $value) {
            if($value === null || $value === 'null' || $value === '_not_null') {
                continue;
            }
            $stmt->bindValue(":$column", $value);
        }

        if(!$usePagination) {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        $countSql = "SELECT COUNT(*) as total FROM " . static::$table;
        if (!empty($filters)) {
            $countSql .= " WHERE " . implode(' AND ', $filterClauses);
        }

        $countStmt = static::$pdo->prepare($countSql);
        foreach ($filters as $column => $value) {
            if($value === null || $value === 'null' || $value === '_not_null') {
                continue;
            }
            $countStmt->bindValue(":$column", $value);
        }

        $countStmt->execute();
        $totalRecords = $countStmt->fetchColumn();

        $totalPages = ceil($totalRecords / $perPage);

        if ($usePagination) {
            $offset = ($currentPage - 1) * $perPage;
            $sql .= " LIMIT :offset, :perPage";

            $stmt = static::$pdo->prepare($sql);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindValue(':perPage', $perPage, PDO::PARAM_INT);
        }

        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);

        $pagination = [
            'total_pages' => $usePagination ? $totalPages : null,
            'current_page' => $usePagination ? $currentPage : null,
            'per_page' => $usePagination ? $perPage : null,
            'total_records' => $usePagination ? $totalRecords : null
        ];

        return [
            'data' => $results,
            'pagination' => $pagination
        ];
    }


    protected static function boot(): void
    {
        if (!isset(static::$pdo)) {
            static::$pdo = Database::getConnection();
        }
        if (!isset(static::$table)) {
            static::$table = (new static())->getTable();
        }
    }
}