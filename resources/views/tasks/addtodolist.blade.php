<!-- Modal -->
<div class="modal fade" id="addTaskModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    {{ __('Add new task list') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="newTaskForm">
                    <div class="container">
                        <div class="vstack gap-3">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="taskListTitle" name="taskItem[title]">
                                <label for="taskListTitle">{{ __('Title:') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="taskListDescription" rows="25"
                                    name="taskItem[description]"></textarea>
                                <label for="taskListDescription">{{ __('Description:') }}</label>
                            </div>

                            <hr>

                            <div class="hstack gap-3">
                                <button type="button" class="btn btn-add-task btn-info">
                                    {{ __('Add task') }}
                                </button>
                            </div>

                            <ul id="newTaskListGroup" class="list-group">
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
                                            <input type="checkbox" class="btn-check" name="taskItem[0][php]" id="php0">
                                            <label class="btn btn-outline-info text-dark" for="php0">PHP</label>

                                            <input type="checkbox" class="btn-check" id="javascript0"
                                                name="taskItem[0][javascript]">
                                            <label class="btn btn-outline-info text-dark"
                                                for="javascript0">JavaScript</label>

                                            <input type="checkbox" class="btn-check" name="taskItem[0][css]" id="css0">
                                            <label class="btn btn-outline-info text-dark" for="css0">CSS</label>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger"
                    data-bs-dismiss="modal">{{ __('Close') }}</button>
                <button type="button" class="btn btn-outline-success" id="saveTaskBtn">{{ __('Save') }}</button>
            </div>
        </div>
    </div>
</div>
