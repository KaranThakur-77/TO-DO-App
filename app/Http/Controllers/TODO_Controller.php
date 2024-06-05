<?php

namespace App\Http\Controllers;

use App\Models\TODOs;
use Illuminate\Http\Request;

class TODO_Controller extends Controller
{
    public function index(){
        $todos = TODOs::get();
        return view("index",["todos"=>$todos]);
    }
    public function store(Request $request){
        $request->validate([
            "task_name"=> "required",
            "task_desc"=> "required",
        ]);

        $todo = new TODOs;
        $todo->todo_title = $request->task_name;
        $todo->todo_description = $request->task_desc;

        $todo->save();
        return redirect("/");
    }
    public function update(Request $request, string $id){
        $request->validate([
            "task_name"=> "required",
            "task_desc"=> "required",
        ]);

        $todo = TODOs::where('id',$id)->first();
        if (!$todo) {
            // If not found, you can return an error response or redirect with an error message
            return redirect('/')->with('error', 'TODO item not found.');
        }
        $todo->todo_title = $request->task_name;
        $todo->todo_description = $request->task_desc;

        $todo->save();
        return redirect("/");
    }
    public function destroy(string $id){
        $todo = TODOs::where("id",$id)->first();
        $todo->delete();
        return back();
    }
}
