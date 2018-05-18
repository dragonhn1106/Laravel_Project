<?php

namespace App\Http\Controllers;

use App\Task;
use \Validator;
use Illuminate\Http\Request;


class ApiTaskController extends Controller
{

    public function index()
    {
        $tasks = Task::all();
        return response()->json([
            'data' => $tasks,
        ]);
    }

    public function show($id)
    {
        $task = Task::findOrfail($id);
        return response()->json([
            'data' => $task,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|max:32',
            ]
        );
        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'message' => $validator->errors(),
            ], 400);
        }
        $task = new Task();
        $findIdTask = $task::findOrFail($id);
        $findIdTask->update($request->all('title'));
        return response()->json([
            'status' => 1,
            'massage' => 'update thanh cong',
            'data' => $findIdTask,
        ]);

    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|max:32',
            ]
        );
        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'message' => $validator->errors(),
            ], 400);
        }
        $createTask = Task::create($request->all('title'));
        return response()->json([
            'status' => 1,
            'message' => 'create thanh cong',
            'data' => $createTask,
        ]);
    }

    public function destroy($id)
    {
        $findIdTask = Task::findOrFail($id);
        if (!$findIdTask) {
            return response()->json([
                'status' => 0,
                'message' => 'not found',
            ], 404);
        }
        $findIdTask->delete();
        return response()->json([
            'status' => 1,
            'message' => 'delete tasks successfully',
        ]);
    }

}
