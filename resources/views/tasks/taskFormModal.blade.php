<!-- Modal -->
<div class="modal fade" id="taskFormModal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    @if (isset($task) && $task->title)
                        {{ __("Edit task {$task->title}") }}
                    @else
                        {{ __('Add new task list') }}
                    @endif

                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="taskForm">
                    <div class="container">
                        <div class="vstack gap-3">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="taskListTitle" name="title"
                                    value="{{ isset($task) ? $task->title : '' }}">
                                <label for="taskListTitle">{{ __('Title:') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="taskListDescription" rows="25"
                                    name="description">{{ isset($task) ? $task->description : '' }}</textarea>
                                <label for="taskListDescription">{{ __('Description:') }}</label>
                            </div>

                            <hr>

                            <div class="hstack gap-3">
                                <button type="button" class="btn btn-add-task btn-info">
                                    {{ __('Add task') }}
                                </button>
                            </div>

                            <ul id="taskListGroup" class="list-group">
                                @if (isset($task) && $task->taskItems != null)
                                    @foreach ($task->taskItems as $taskItem)
                                        <li class="list-group-item">
                                            <div class="vstack gap-3">
                                                <div class="hstack gap-3">
                                                    <button type="button"
                                                        class="btn btn-delete-task btn-outline-danger">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>

                                                    <div class="form-floating w-100 me-auto">
                                                        <input type="text" class="form-control"
                                                            name="taskItem[{{ $loop->index }}][title]"
                                                            value="{{ $taskItem->title }}">
                                                        <label>{{ __('Task:') }}</label>
                                                    </div>
                                                </div>


                                                <div class="btn-group" role="group">
                                                    <input type="checkbox" class="btn-check"
                                                        name="taskItem[{{ $loop->index }}][php]"
                                                        id="php{{ $loop->index }}"
                                                        {{ $taskItem->php ? 'checked' : '' }} />
                                                    <label class="btn btn-outline-info text-dark"
                                                        for="php{{ $loop->index }}">PHP</label>

                                                    <input type="checkbox" class="btn-check"
                                                        id="js{{ $loop->index }}"
                                                        name="taskItem[{{ $loop->index }}][js]"
                                                        {{ $taskItem->js ? 'checked' : '' }} />
                                                    <label class="btn btn-outline-info text-dark"
                                                        for="js{{ $loop->index }}">JavaScript</label>

                                                    <input type="checkbox" class="btn-check"
                                                        name="taskItem[{{ $loop->index }}][css]"
                                                        id="css{{ $loop->index }}"
                                                        {{ $taskItem->css ? 'checked' : '' }} />
                                                    <label class="btn btn-outline-info text-dark"
                                                        for="css{{ $loop->index }}">CSS</label>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="list-group-item">
                                        <div class="vstack gap-3">
                                            <div class="hstack gap-3">
                                                <button type="button" class="btn btn-delete-task btn-outline-danger">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>

                                                <div class="form-floating w-100 me-auto">
                                                    <input type="text" class="form-control" name="taskItem[0][title]">
                                                    <label>{{ __('Task:') }}</label>
                                                </div>
                                            </div>


                                            <div class="btn-group" role="group">
                                                <input type="checkbox" class="btn-check" name="taskItem[0][php]"
                                                    id="php0">
                                                <label class="btn btn-outline-info text-dark" for="php0">PHP</label>

                                                <input type="checkbox" class="btn-check" id="js0"
                                                    name="taskItem[0][js]">
                                                <label class="btn btn-outline-info text-dark"
                                                    for="js0">JavaScript</label>

                                                <input type="checkbox" class="btn-check" name="taskItem[0][css]"
                                                    id="css0">
                                                <label class="btn btn-outline-info text-dark" for="css0">CSS</label>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="reset" class="btn btn-outline-danger">{{ __('Clean') }}</button>

                @if (@isset($task))
                    <button type="button" class="btn btn-outline-success" id="editTaskBtn">{{ __('Save') }}</button>
                @else
                    <button type="button" class="btn btn-outline-success" id="saveTaskBtn">{{ __('Save') }}</button>
                @endif

            </div>
        </div>
    </div>
</div>
