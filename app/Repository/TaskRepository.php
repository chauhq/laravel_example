<?php

namespace App\Repository;

use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\UserResource;
use App\Models\Task;
use App\Models\User;
use App\Repository\Interface\TaskRepositoryInterface;
use Illuminate\Http\Request;

class TaskRepository implements TaskRepositoryInterface
{

    public function index(Request $request)
    {
        $title = $request->title;
        $type = $request->type;
        $tasks = Task::with('users');
        if (!is_null($title)) {
            $tasks->where('title', 'like', "%{$title}%");
        }
        if (!is_null($type)) {
            $tasks->where('type', $type);
        }
        return $tasks->get();
    }

    public function show($id)
    {
        return Task::find($id);
    }

    public function store(StoreTaskRequest $request)
    {
        $task = new Task();
        $task->title = $request->title;
        $task->assignee = $request->assignee;
        $task->save();
        return $task->fresh();
    }

    public function destroy($id)
    {
        $task = Task::find($id);
        if (!is_null($task)) {
            $task->delete();
        }
        return $task;
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        if (!is_null($task)) {
            $title = $request->title;
            $assignee = $request->assignee;
            if (!is_null($title)) {
                $task->title = $title;
            }

            if (!is_null($assignee)) {
                $user = User::find($assignee);
                if (!is_null($user)) {
                    $task->assignee = $assignee;
                }
            }
            $task->save();
        }
        return $task;
    }
}
