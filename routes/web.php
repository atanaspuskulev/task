<?php

declare(strict_types=1);

use Lib\Router;
use App\Controllers;

Router::get('/', [Controllers\IndexController::class, 'index']);
Router::get('/tasks/delete/{id}', [Controllers\IndexController::class, 'delete']);
Router::post('/tasks/update/{id}', [Controllers\IndexController::class, 'update']);