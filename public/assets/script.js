function handleTaskStatus(el) {
    const isChecked = el.is(':checked');
    const currentUrl = new URL(window.location.href);
    const params = new URLSearchParams(currentUrl.search);

    params.set('completed_at_filter', isChecked ? '_not_null' : null);

    location.href = `${currentUrl.pathname}?${params.toString()}`;
}

function openDeleteModal(id) {
    let deleteUrl = '/tasks/delete/' + id;
    $('#deleteModal .btn-danger').attr('data-url', deleteUrl);

    $('#deleteModal').modal('show');
}

function openCompleteModal(id) {
    let updateUrl = '/tasks/update/' + id;
    $('#completeModal .btn-success').attr('data-url', updateUrl);

    $('#completeModal').modal('show');
}

function confirmDelete() {
    location.href = $('#deleteModal .btn-danger').attr('data-url');
}

function confirmComplete() {
    $.post($('#completeModal .btn-success').attr('data-url'), function () {
        location.reload();
    })
}

function openCreateModal() {
    $('#createTaskModal').modal('show');
}

function createTask() {
    const title = $('#createTaskModal input[name="title"]').val().trim();
    const description = $('#createTaskModal textarea[name="content"]').val().trim();

    if (title === '') {
        alert('Please provide a title for the task.');
        return;
    }

    if (description === '') {
        alert('Please provide a description for the task.');
        return;
    }

    $.post('/tasks/create', { title, description }, function () {
        location.href = '/';
    })
}