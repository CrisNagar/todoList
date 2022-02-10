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
                            <button id="btnShowTaskFormModal" type="button"
                                class="btn btn-outline-success align-items-center" data-bs-toggle="tooltip"
                                data-bs-placement="bottom" title="{{ __('Add new taks') }}" data-bs-toggle="modal"
                                data-bs-target="#taskFormModal">
                                <i class="fas fa-plus-circle"></i>
                            </button>
                        </div>
                    </div>


                    <div id="taskTable" class="card-body">
                        @include('tasks.taskTable')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="taskModal">
        @include('tasks.taskFormModal')
    </div>
@endsection
