<?php

namespace App\Controllers;

use App\Services\TaskService;
use Lib\Request;
use Lib\Router;
use Lib\View;

class IndexController extends MainController
{
    public function __construct(private TaskService $taskService)
    {
    }

    public function index(Request $request)
    {
        $tasks = $this->taskService->getAll($request);

        $sortDirection = 'asc';
        if ($request->get('order_by')) {
            $sortDirection = $request->get('direction') === 'asc' ? 'desc' : 'asc';
        }

        return $this->view('index.php', [
            'tasks' => $tasks['data'],
            'sortDirection' => $sortDirection,
            'pagination' => $tasks['pagination']
        ]);
    }

    public function delete(int $id): void
    {
        $this->taskService->delete($id);

        Router::back();
    }

    public function update(int $id): void
    {
        $data = [
            'completed_at' => date('Y-m-d H:i:s')
        ];

        $this->taskService->update($id, $data);
    }
}