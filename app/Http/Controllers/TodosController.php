<?php

namespace App\Http\Controllers;

use App\Models\Todos;
use Illuminate\Http\Request;

class TodosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Todos::all();

        return response()->json($todos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required'],
            'description' => ['required'],
            'isDone' => ['required'],
        ]);

        $todo = new Todos();

        $todo->name = $validatedData['name'];
        $todo->description = $validatedData['description'];
        $todo->isDone = $validatedData['isDone'];

        $todo->save();

        return response()->json(["id" => $todo->id], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $todo = Todos::find($id);

        if (!empty($todo)) {
            return response()->json($todo);
        } else {
            return response()->json([
                "message" => "Todo not found"
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        if (Todos::where('id', $id)->exists()) {
            $todo = Todos::find($id);

            $todo->name = $request->name ?? $todo->name;
            $todo->description = $request->description ?? $todo->description;
            $todo->isDone = $request->isDone ?? $todo->isDone;

            $todo->save();

            return response()->json(["message" => "Todo updated"], 200);
        } else {
            return response()->json([
                "message" => "Todo not found"
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        if (Todos::where('id', $id)->exists()) {
            $todo = Todos::find($id);

            $todo->delete();

            return response()->json(["message" => "Todo deleted"], 200);
        } else {
            return response()->json([
                "message" => "Todo not found"
            ], 404);
        }
    }
}
