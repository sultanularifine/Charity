<?php

namespace App\Http\Controllers;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();
        return view('backend.dashboard', ['data' => $todos]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'time' => 'required',
            'date' => 'required',
        ]);

        $todo = new Todo();
        $todo->name = $request->name;
        $todo->time = $request->time;
        $todo->date = $request->date;
        $todo->save();
        return redirect()->back();
    }

    public function edit($id)
    {

        $todo = Todo::find($id);
        return view('backend.edit', ['data' => $todo]);
    }
    public function update(Request $request, $id)
    {

        $todo = Todo::find($id);
        $todo->name = $request->name;
        $todo->time = $request->time;
        $todo->date = $request->date;
        $todo->save();

        return redirect()->route('dashboard');

    } 
    public function destroy($id)
    {
        $todo = Todo::find($id);
        if($todo->delete()){
            return redirect()->back();
        }
        
        
       
    }
}
