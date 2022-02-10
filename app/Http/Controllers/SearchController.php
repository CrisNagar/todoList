<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskItem;

class SearchController extends Controller
{
    /**
     * Search a Task in database.
     *
     * @param String $query
     * @return Illuminate\Http\Response
     */
    public function search($query)
    {
        if ($query == '' || $query == null) {
            return response()->json(view('tasks.taskTable', ['taskList' => Task::all()])->render());
        }

        $task = Task::select('*')
            ->where('title', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->get();

        return response()->json(view('tasks.taskTable', ['taskList' => $task])->render());
    }
}
