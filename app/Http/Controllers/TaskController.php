<?php

namespace App\Http\Controllers;

use App\Task;
use \Validator;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks', ['tasks' => $tasks]);
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
            return $validator->errors();
        }
        $task = new Task();
        $task->title = $request->title;
        $task->save();
        return redirect('/tasks');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id)->delete();
        return redirect('/tasks');
    }

    public function update(Request $request, $id)
    {
        $task = new Task();
        $findIdTask = $task::findOrFail($id);
        $findIdTask->update($request->all('title'));
        return redirect('/tasks');
    }
}
