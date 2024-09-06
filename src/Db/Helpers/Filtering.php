<?php

namespace Lib\Db\Helpers;

class Filtering
{
    public static function getFilterArray(array $filters): array
    {
        $filterClauses = [];
        foreach ($filters as $column => $value) {
            if($value === 'null') {
                // Handle js strings
                $value = null;
            }

            if ($value === null) {
                $filterClauses[] = "$column IS NULL";
            } elseif ($value === '_not_null') {
                $filterClauses[] = "$column IS NOT NULL";
            } else {
                $filterClauses[] = "$column = :$column";
            }
        }

        return $filterClauses;
    }
}