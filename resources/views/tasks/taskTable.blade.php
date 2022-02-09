@if (isset($taskList) && count($taskList) > 0)
    <div class="accordion accordion-flush mt-5" id="accordionTasks">
        @foreach ($taskList as $task)
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading{{ $task->id }}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#AccordionBtn{{ $task->id }}" aria-expanded="false"
                        aria-controls="AccordionBtn{{ $task->id }}">
                        {{ $task->title }}
                    </button>
                </h2>
                <div id="AccordionBtn{{ $task->id }}" class="accordion-collapse collapse"
                    aria-labelledby="heading{{ $task->id }}" data-bs-parent="#accordionTasks">
                    <div class="accordion-body">
                        <div class="vstack gap-3">
                            <div class="hstack">
                                <h4 class="me-auto">{{ $task->description }}</h4>

                                <div class="btn-group" role="group" aria-label="Action buttons">
                                    <button type="button" class="btn btn-delete btn-outline-danger"
                                        data-task="{{ $task->id }}" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Delete task">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    <button type="button" class="btn btn-edit btn-outline-info"
                                        data-task="{{ $task->id }}" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Edit task">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-resolve btn-outline-success"
                                        data-task="{{ $task->id }}" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Resolve task">
                                        <i class="fas fa-tasks"></i>
                                    </button>
                                </div>
                            </div>


                            <ul class="list-group mt-3">
                                @foreach ($task->taskItems as $item)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                id="{{ $item->title }}{{ $item->id }}">

                                            <label class="form-check-label"
                                                for="{{ $item->title }}{{ $item->id }}">
                                                <h6>{{ $item->title }}</h6>
                                            </label>
                                        </div>

                                        <div class="badges">
                                            @if ($item->php)
                                                <span class="badge bg-primary">
                                                    <i class="fab fa-php fa-2x"></i>
                                                </span>
                                            @endif
                                            @if ($item->js)
                                                <span class="badge bg-warning">
                                                    <i class="fab fa-js-square fa-2x"></i>
                                                </span>
                                            @endif
                                            @if ($item->css)
                                                <span class="badge bg-info">
                                                    <i class="fab fa-css3-alt fa-2x"></i>
                                                </span>
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="alert alert-warning" role="alert">
        <strong>{{ __('Ups!') }}</strong> {{ __('Add a new task list to see it here') }}
    </div>
@endif
