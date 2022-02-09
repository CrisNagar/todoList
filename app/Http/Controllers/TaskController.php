<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response 
     */
    public function store(Request $request)
    {
        if ($request->ajax() && $request->isMethod('post')) {
            $validated = $request->validate([
                'title' => 'required',
            ]);

            if (!$validated) {
                return response()->json(__('Title is required'));
            }

            $data = $request->all();

            $task = new Task();
            $task->mapping([
                'title' => $data['title'],
                'description' => empty($data['description'] ? '' : $data['description'])
            ]);
            $task->user_id = Auth::user()->id;
            $task->save();

            if (!empty($data['taskItem'])) {
                foreach ($data['taskItem'] as $item) {
                    $taskItem = new TaskItem();
                    $taskItem->task_id = $task->id;
                    $taskItem->mapping($item);
                    $taskItem->save();
                }
            }

            $all = Task::all();
            return response()->json(view('tasks.taskTable', ['taskList' => $all])->render());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $Task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $Task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
