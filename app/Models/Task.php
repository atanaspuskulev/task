<?php

declare(strict_types=1);

namespace App\Models;

use Lib\Db\Model;

class Task extends Model
{
    protected function getTable(): string
    {
        return 'tasks';
    }
}