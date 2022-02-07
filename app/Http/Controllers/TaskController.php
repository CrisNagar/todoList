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
        $all = Task::all();

        if (isset($_GET['reloadData']) && $_GET['reloadData'] == 'true') {
            foreach ($all as $Task) {
                $items = TaskItem::where('id', $Task->id)->first();
                return response()->json($items);
            }
        }
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
        if ($request->ajax() && $request->method() == 'POST') {
            $task = new Task();

            $data = $request->all();

            if (!empty($data['title']) && !empty($data['description'])) {
                $task->mapping([
                    'title' => $data['title'],
                    'description' => $data['description']
                ]);
                $task->user_id = Auth::user()->id;
                $task->save();
            }

            if (!empty($data['taskItem'])) {
                foreach ($data['taskItem'] as $item) {
                    $taskItem = new TaskItem();
                    $taskItem->task_id = $task->id;
                    $taskItem->mapping($item);
                    $taskItem->save();
                }
            }

            return response()->json($task);
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
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
