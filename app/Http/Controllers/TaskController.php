<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    private $user;

    public function __construct()
    {
        $this->user = auth()->user();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tasks = $this->user->tasks;
        return response()->json(
            $tasks,
            200
        );
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        if ($this->user->cannot('view', $task)) {
            return response(null, 404);
        }

        return response()->json(
            $task,
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTaskRequest $request)
    {
        $task = new Task;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->user_id = $this->user->id;
        $task->save();

        return response()->json([
            'message' => 'Task successfully Created',
            'task' => $task
        ], 201);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        if ($this->user->cannot('update', $task)) {
            return response(null, 404);
        }

        $task->title = $request->title;
        $task->description = $request->description;
        $task->save();

        return response()->json([
            'message' => 'Task successfully Updated',
            'task' => $task
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *wd
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        if ($this->user->cannot('delete', $task)) {
            return response(null, 404);
        }

        if ($task->delete()) {
            return response()->json(null, 204);
        }
    }
}
