@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="hstack gap-3 p-2">
                        <input class="form-control me-auto" type="text" placeholder="Search your tasks..."
                            aria-label="Search your tasks...">
                        <button type="button" class="btn btn-secondary">{{ __('Search') }}</button>
                        <div class="vr"></div>
                        <div class="text-end m-auto">
                            <button type="button" class="btn btn-show-modal btn-outline-success align-items-center"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ __('Add new taks') }}"
                                data-bs-toggle="modal" data-bs-target="#addTaskModal">
                                <i class="fas fa-plus-circle"></i>
                            </button>
                        </div>
                    </div>


                    <div class="card-body">
                        @if (count($todoList) > 0)
                            <div class="accordion mt-5" id="accordionTasks">
                                @foreach ($todoList as $task)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#{{ trim($task->title) }}" aria-expanded="false"
                                                aria-controls="collapseOne">
                                                {{ $task->title }}
                                            </button>
                                        </h2>
                                        <div id="{{ trim($task->title) }}" class="accordion-collapse collapse show"
                                            aria-labelledby="headingOne" data-bs-parent="#accordionTasks">
                                            <div class="accordion-body">
                                                {{ $task->description }}
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('tasks.addtodolist')
@endsection
