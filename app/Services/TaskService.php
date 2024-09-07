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
        } else {
            $orderByFiltering = [
                'created_at' => 'desc'
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

    public function create(array $data)
    {
        if(empty($data['created_at'])) {
            $data['created_at'] = date('Y-m-d H:i:s');
        }

        return Task::create($data);
    }

    public function show(int $id)
    {
        return Task::getOneById($id);
    }
}