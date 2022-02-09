<script>
    document.addEventListener('DOMContentLoaded', load, false);

    const modal = new bootstrap.Modal(document.getElementById('taskFormModal'));
    const toast = new bootstrap.Toast(document.getElementById('toastAlert'));

    function load() {
        $.ajaxSetup({
            enctype: 'multipart/form-data',
            dataType: 'json',
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        btnListener('modals');
        setActionButtons();
        initTooltips();

    }

    function toggleModal() {
        modal.toggle();
    }

    function initTooltips() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    }

    function initShowTaskForm() {
        const modalButton = document.getElementById('btnShowTaskFormModal');
        modalButton[i].addEventListener('click', function() {
            toggleModal();
            btnListener('newTaskItem');
            btnListener('deleteNewTaskItem');
        })
    }

    function toggleToast(type, message) {
        document.getElementById('toastAlert').setAttribute('class', `bg-${type} position-absolute bottom-0 end-0 m-3`);
        document.getElementById('toastMessage').innerText = message;
        toast.show()
    }

    function addNewTaskItem() {
        const listGroup = document.getElementById('taskListGroup');
        const number = listGroup.children.length;

        let li = document.createElement('li');
        li.setAttribute('class', 'list-group-item');

        let vstackParent = document.createElement('div');
        vstackParent.setAttribute('class', 'vstack gap-3');

        let hstack = document.createElement('div');
        hstack.setAttribute('class', 'hstack gap-3');

        let btnDelete = document.createElement('button');
        btnDelete.setAttribute('class', 'btn btn-delete-task btn-outline-danger');
        btnDelete.setAttribute('type', 'button');

        let trashIcon = document.createElement('i')
        trashIcon.setAttribute('class', 'fas fa-trash-alt');

        btnDelete.appendChild(trashIcon);

        let divFloating = document.createElement('div');
        divFloating.setAttribute('class', 'form-floating w-100 me-auto');

        let inputText = document.createElement('input');
        inputText.setAttribute('class', 'form-control');
        inputText.setAttribute('type', 'text');
        inputText.setAttribute('name', `taskItem[${number}][title]`);

        let label = document.createElement('label');
        label.innerText = 'Task:';

        let btnGroup = document.createElement('div');
        btnGroup.setAttribute('class', 'btn-group');
        btnDelete.setAttribute('role', 'group');

        let btnPHP = document.createElement('input');
        btnPHP.setAttribute('class', 'btn-check');
        btnPHP.setAttribute('type', 'checkbox');
        btnPHP.setAttribute('id', `php${number}`);
        btnPHP.setAttribute('name', `taskItem[${number}][php]`);

        let labelPHP = document.createElement('label');
        labelPHP.setAttribute('class', 'btn btn-outline-info text-dark');
        labelPHP.setAttribute('for', `php${number}`);
        labelPHP.innerText = 'PHP';

        let btnJS = document.createElement('input');
        btnJS.setAttribute('class', 'btn-check');
        btnJS.setAttribute('type', 'checkbox');
        btnJS.setAttribute('id', `js${number}`);
        btnJS.setAttribute('name', `taskItem[${number}][js]`);

        let labelJS = document.createElement('label');
        labelJS.setAttribute('class', 'btn btn-outline-info text-dark');
        labelJS.setAttribute('for', `js${number}`);
        labelJS.innerText = 'JavaScript';

        let btnCSS = document.createElement('input');
        btnCSS.setAttribute('class', 'btn-check');
        btnCSS.setAttribute('type', 'checkbox');
        btnCSS.setAttribute('id', `css${number}`);
        btnCSS.setAttribute('name', `taskItem[${number}][css]`);

        let labelCSS = document.createElement('label');
        labelCSS.setAttribute('class', 'btn btn-outline-info text-dark');
        labelCSS.setAttribute('for', `css${number}`);
        labelCSS.innerText = 'CSS';

        btnGroup.appendChild(btnPHP);
        btnGroup.appendChild(labelPHP);

        btnGroup.appendChild(btnJS);
        btnGroup.appendChild(labelJS);

        btnGroup.appendChild(btnCSS);
        btnGroup.appendChild(labelCSS);

        divFloating.appendChild(inputText);
        divFloating.appendChild(label);

        hstack.appendChild(btnDelete);
        hstack.appendChild(divFloating);

        vstackParent.appendChild(hstack);
        vstackParent.appendChild(btnGroup);

        li.appendChild(vstackParent);

        listGroup.appendChild(li);

        btnListener('deleteNewTaskItem');
    }

    function removeNewTask(el) {
        el.parentNode.parentNode.parentNode.remove();
    }

    function btnListener(type) {
        if (type == 'newTaskItem') {
            let newTasksButtons = document.getElementsByClassName('btn-add-task');
            for (let i = 0; i < newTasksButtons.length; i++) {
                newTasksButtons[i].addEventListener('click', function() {
                    addNewTaskItem();
                });
            }

            let saveButton = document.getElementById('saveTaskBtn');
            saveButton.addEventListener('click', function(e) {
                e.preventDefault();
                saveTask(document.getElementById('taskForm'));
            })
        }

        if (type == 'deleteNewTaskItem') {
            let removeNewTasksButtons = document.getElementsByClassName('btn-delete-task');
            for (let i = 0; i < removeNewTasksButtons.length; i++) {
                removeNewTasksButtons[i].addEventListener('click', function() {
                    removeNewTask(this);
                });
            }
        }
    }

    function setActionButtons() {
        const btnDelete = document.getElementsByClassName('btn-delete');
        const btnEdit = document.getElementsByClassName('btn-edit');
        const btnResolve = document.getElementsByClassName('btn-resolve');

        for (let i = 0; i < btnDelete.length; i++) {
            btnDelete[i].addEventListener('click', function() {
                deleteTask(this.dataset.task);
            });
        }

        for (let i = 0; i < btnEdit.length; i++) {
            btnEdit[i].addEventListener('click', function() {
                const id = this.dataset.task
                getTask(id);

                /* document.getElementById('editTaskBtn').addEventListener('click', function(e) {
                    e.preventDefault();
                    editTask(id);
                }); */

                btnListener('newTasks');
                btnListener('deleteNewTaskItem');
            });
        }

        for (let i = 0; i < btnResolve.length; i++) {
            btnResolve[i].addEventListener('click', function() {
                resolveTask(this.dataset.task);
            });
        }
    }

    function saveTask(task) {
        let formData = new FormData(task);
        formData.append('_token', '{{ csrf_token() }}');

        $.ajax({
            url: "{{ route('task.store') }}",
            method: 'POST',
            data: formData
        }).done((res) => {
            task.reset();
            toggleModal();
            document.getElementById('taskTable').innerHTML = res;
        }).fail((error) => {
            toggleModal();
            toggleToast('danger', 'Save task is FAIL!');
            console.log(error);
        });
    }

    function editTask(task) {
        let url = "{{ route('task.edit', ':id') }}";
        url = url.replace(':id', task);

        return console.log(modal)
        $.ajax({
            url: url,
            method: 'PUT',
        }).done((res) => {
            task.reset();
            toggleModal();
            console.log(res);
        }).fail((error) => {
            console.log(error);
        });
    }

    function getTask(task) {
        let url = "{{ route('task.edit', ':id') }}";
        url = url.replace(':id', task);
        $.ajax({
            url: url,
            method: 'POST',
        }).done((res) => {
            modal.dispose();
            document.getElementById('taskModal').innerHTML = res;
            setModal(document.getElementById('taskFormModal'));
            toggleModal();
            console.log(res);
        }).fail((error) => {
            console.log(error);
        });
    }

    function deleteTask(task) {
        let url = "{{ route('task.destroy', ':id') }}";
        url = url.replace(':id', task);

        $.ajax({
            url: url,
            method: 'DELETE'
        }).done((res) => {
            console.log(res);
        }).fail((error) => {
            console.log(error);
        });
    }

    function resolveTask(task) {
        $.ajax({
            url: "{{ route('task.store') }}",
            method: 'POST',
            data: task,
            success: function(res) {
                toggleModal();
                reloadData();
                task.reset();
                console.log(res.message);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>
