<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    private $userID;

    public function __construct() {
        $this->userID = auth()->user()->id;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $tasks = Task::all(['id','title','user_id','description'])->where('user_id', $this->userID);
        return response()->json( $tasks );
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $t = Task::where('user_id', $this->userID)->where('id', $task->id)->first();

        if(!empty($t)){
            return response()->json($t);
        } else {
            return response()->json([
                'status' => 'error',
                'message'    => 'Error',
                ], 404
            );
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|min:5',
            'description' => 'required|min:20',
        ]; 
        
        $validatedData = $request->validate($rules);
        $validatedData['user_id'] = $this->userID;

        $task = Task::create(array_merge(
                    $validatedData
                ));

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
    public function update(Request $request, Task $task)
    {
        $task = Task::where('user_id', $this->userID)->where('id', $task->id)->first();
        $rules = [
            'title' => 'required|min:5',
            'description' => 'required|min:20',
        ]; 
        
        $validatedData = $request->validate($rules);
        $task->title = $validatedData['title'];
        $task->description = $validatedData['description'];
        $task->save();

        return response()->json([
            'message' => 'Task successfully Updated',
            'task' => $task
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *wd
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {

        $task = Task::where('user_id', $this->userID)->where('id', $task->id)->first();
        if( $task->delete() ) {
            return response()->json([
                'message' => 'Task successfully Updated',
                'task' => $task
            ], 201);    
        }

    
    }


}
