<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    private $userID;
    private $actionMessage;
    private $authMessage;

    public function __construct() {
        $this->userID = auth()->user()->id;
        $this->actionMessage = "Failed";
        $this->authMessage = 1;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $tasks = Task::all(['id','title','user_id','description','created_at'])->where('user_id', $this->userID);
        return response()->json($tasks);
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

        if(!empty( $t )){
            $this->actionMessage = "Successful";
            $this->authMessage =  0;
            return response()->json( $t );
        }
        
        return response()->json([
            'message'=> $this->actionMessage,
            'authMessage' => $this->authMessage,
            'task'=> $task
        ]); 

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = new Task;
        $task->user_id = $this->userID;
        $task->title = $request->title;
        $task->description = $request->description;
        if( $task->save() ) {
            $this->actionMessage = "Successful";
            $this->authMessage =  0;
        }
        
        return response()->json([
            'message'=> $this->actionMessage,
            'authMessage' => $this->authMessage,
            'task'=> $task
        ]); 
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
        $task->title = $request->title;
        $task->description = $request->description;

        if( $task->update() ) {
            $this->actionMessage = "Successful";
            $this->authMessage =  0;
        }

        return response()->json([
            'message'=> $this->actionMessage,
            'authMessage' => $this->authMessage,
            'task'=> $task
        ]); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {

        $task = Task::where('user_id', $this->userID)->where('id', $task->id)->first();
        if( $task->delete() ) {
            $this->actionMessage = "Successful";
            $this->authMessage =  0;
        }

        return response()->json([
            'message'=> $this->actionMessage,
            'authMessage' => $this->authMessage,
            'task'=> $task
        ]); 
        
    }


}
