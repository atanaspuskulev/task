<?php

namespace App\Services;

use App\Models\Task;
use Lib\Request;

class TaskService
{
    public function getAll(Request $request)
    {
        $orderByFiltering = [];

        if($request->get('order_by')) {
            $orderByFiltering = [
               $request->get('order_by') => $request->get('direction', 'asc')
            ];
        }

        $filtering = [
            'completed_at' => $request->get('completed_at_filter'),
        ];

        return Task::get(
            orderBy: $orderByFiltering,
            filters: $filtering,
            usePagination: true,
            currentPage: $request->get('page', 1)
        );
    }

    public function delete(int $id): bool
    {
        return Task::delete($id);
    }

    public function update(int $id, array $data)
    {
        return Task::update($id, $data);
    }
}