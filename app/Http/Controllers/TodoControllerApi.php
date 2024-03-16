<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TodoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TodoControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$todos = TodoModel::all();
        $todos = TodoModel::where('user_id', Auth::user()->id)->get();
        return response()->json(['todos' => $todos]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|min:8|alpha:ascii'
        ]);

        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->toArray()], 400);
        }

        $todo = new TodoModel();
        $todo->title = $request->get('title');
        $todo->user()->associate(Auth::user());
        $todo->save();

        return response()->json(['message' => 'Todo added successfully']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:8|alpha:ascii'
        ]);

        if($validator->fails()) {
            return redirect()->route('todo.edit', ['id' => $id])->withErrors($validator);
        }

        $todo = TodoModel::where('id', $id)->first();

        $todo->title = $request->get('title');
        $todo->is_completed = $request->get('is_completed');
        $todo->save();

        return response()->json(['message' => 'Todo modified successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        TodoModel::where('id', $id)->delete();
        return response()->json(['message' => 'Todo deleted successfully']);
    }
}
