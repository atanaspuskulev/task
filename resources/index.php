<div class="container mt-5">
    <div class="row">
        <div class="col">
            <h3>My Tasks</h3>
            <hr />
        </div>
    </div>
    <div class="row">
        <div class="col-md-10">
            <h6>Filters</h6>
        </div>
        <div class="col-md-2 pb-2">
            <button class="btn btn-primary float-end" onclick="openCreateModal()">Create Task</button>
        </div>
        <hr>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-check form-switch">
                <input
                        class="form-check-input"
                        type="checkbox"
                        <?php if(\Lib\Request::get('completed_at_filter') == '_not_null'): ?>
                        checked
                        <?php endif; ?>
                        onchange="handleTaskStatus($(this));"
                >
                <label class="form-check-label" for="flexSwitchCheckDefault">Show completed tasks only</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">
                            <a href="?order_by=id&direction=<?php echo $sortDirection; ?>">#</a>
                        </th>
                        <th scope="col">
                            <a href="?order_by=title&direction=<?php echo $sortDirection; ?>">Title</a>
                        </th>
                        <th scope="col">
                            <a href="?order_by=completed_at&direction=<?php echo $sortDirection; ?>">Completed</a>
                        </th>
                        <th scope="col">
                            <a href="?order_by=created_at&direction=<?php echo $sortDirection; ?>">Created At</a>
                        </th>
                        <th scope="col">Completed At</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($tasks)): ?>
                        <tr>
                            <td colspan="6" class="text-center">No tasks found</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($tasks as $task): ?>
                            <tr class="<?php if($task->completed_at): ?>strikethrough<?php endif; ?>">
                                <th scope="row"><?php echo  $task->id; ?></th>
                                <td><?php echo $task->title; ?></td>
                                <td><?php echo $task->completed_at ? 'Yes' : 'No'; ?></td>
                                <td><?php echo \App\Helpers\DateTimeHelper::formatFromConfig($task->created_at); ?></td>
                                <td><?php echo $task->completed_at ?? '-'; ?></td>
                                <td>
                                    <a title="View Task" class="btn btn-sm btn-primary" onclick="openViewModal('<?php echo $task->id; ?>'); return false;">
                                        <i class="bi bi-play-btn-fill"></i>
                                    </a>
                                    <a title="Complete task" class="btn btn-sm btn-success" onclick="openCompleteModal('<?php echo $task->id; ?>'); return false;">
                                        <i class="bi bi-ubuntu"></i>
                                    </a>
                                    <a title="Delete task" href="#" class="btn btn-sm btn-danger" onclick="openDeleteModal('<?php echo $task->id; ?>'); return false;">
                                        <i class="bi bi-trash-fill danger"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            <?php if (isset($pagination) && $pagination['total_pages'] > 1): ?>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php if ($pagination['current_page'] > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="<?php echo \App\Helpers\Pagination::updateQueryString($pagination['current_page'] - 1); ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $pagination['total_pages']; $i++): ?>
                            <li class="page-item <?php if ($i == $pagination['current_page']): ?>active<?php endif; ?>">
                                <a class="page-link" href="<?php echo \App\Helpers\Pagination::updateQueryString($i); ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($pagination['current_page'] < $pagination['total_pages']): ?>
                            <li class="page-item">
                                <a class="page-link" href="<?php echo \App\Helpers\Pagination::updateQueryString($pagination['current_page'] + 1); ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            <?php endif; ?>

        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="DeleteModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="DeleteModalTitle">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this task?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" onclick="confirmDelete();">DELETE</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="completeModal" tabindex="-1" aria-labelledby="CompleteModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="CompleteModalTitle">Complete Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to mark this task as completed?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" onclick="confirmComplete();">COMPLETE</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="createTaskModal" tabindex="-1" aria-labelledby="CreateModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="CreateModalTitle">Add New Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="task_title" class="form-label">Task title</label>
                    <input type="text" class="form-control" id="task_title" name="title">
                </div>
                <div class="mb-3">
                    <label for="task_content" class="form-label">Task description</label>
                    <textarea class="form-control" id="task_content" rows="3" name="content"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" onclick="createTask();">ADD TASK</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewTaskModal" tabindex="-1" aria-labelledby="ViewModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ViewModalTitle">Task Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <h3 class="task_title_details"></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p class="task_content_details"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <span><b>Created At: </b></span>
                    </div>
                    <div class="col-md-9">
                        <span class="task_created_at_details"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <span><b>Completed At: </b></span>
                    </div>
                    <div class="col-md-8">
                        <span class="task_completed_at_details"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>