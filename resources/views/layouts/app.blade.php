<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TODO - LIST') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <!-- Custom style by page -->
    @yield('style')
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="fas fa-check-double fa-2x"></i>
                    {{ config('app.name', 'TODO - LIST') }}
                </a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-capitalize" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="GET"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
        integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous">
    </script>

    <!-- Custom script by page -->
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

        function toggleToast(type, message) {
            document.getElementById('toastAlert').setAttribute('class', `bg-${type} position-absolute bottom-0 end-0 m-3`);
            document.getElementById('toastMessage').innerText = message;
            toast.show()
        }

        function addNewTaskItem() {
            const listGroup = document.getElementById('newTaskListGroup');
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
            if (type == 'modals') {
                let modalButtons = document.getElementsByClassName('btn-show-modal');
                for (let i = 0; i < modalButtons.length; i++) {
                    modalButtons[i].addEventListener('click', function() {
                        ACTION_FORM = 'create';
                        toggleModal();
                        btnListener('newTasks');
                        btnListener('deleteNewTaskItem');
                    });
                }
            }

            if (type == 'newTasks') {
                let newTasksButtons = document.getElementsByClassName('btn-add-task');
                for (let i = 0; i < newTasksButtons.length; i++) {
                    newTasksButtons[i].addEventListener('click', function() {
                        addNewTaskItem();
                    });
                }

                let saveButton = document.getElementById('saveTaskBtn');
                saveButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    saveTask(document.getElementById('newTaskForm'));
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
                    editTask(this.dataset.task);
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
            $.ajax({
                url: url,
                method: 'POST',
            }).done((res) => {
                task.reset();
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
                method: 'DELETE',
                success: function(res) {
                    reloadData();
                    console.log(res);
                },
                error: function(error) {
                    console.log(error);
                }
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

        function reloadData() {
            let url = "{{ route('task.index', ['reloadData' => ':needReload']) }}";
            url = url.replace(':needReload', true);

            $.ajax({
                url: url,
                method: 'GET',
                success: function(res) {
                    setActionButtons();
                    console.log(res);
                },
                error: function(error) {
                    console.log(error);
                }
            });

            location.reload();
        }
    </script>
    @yield('script')
</body>

</html>
