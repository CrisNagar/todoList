<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskItem;
use Illuminate\Http\Request;

class TaskItemController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TaskItem  $taskItem
     * @return \Illuminate\Http\Response
     */
    public function updateSingle(Request $request, TaskItem $taskItem)
    {
        $taskItem->isFinished = !$taskItem->isFinished;
        $taskItem->save();

        return "Update!!!";
    }

    /**
     * Update a group TaskItem in Task.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function updateGroup(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        foreach ($task->taskItems as $taskItem) {
            $taskItem->isFinished = true;
            $taskItem->save();
        }
        return $this->ajaxReturn();
    }

    /**
     * Return method to ajax methods
     */
    private function ajaxReturn()
    {
        $all = Task::all();
        return response()->json(view('tasks.taskTable', ['taskList' => $all])->render());
    }
}
