<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\User;
use App\Models\Task;
use App\Repository\Interface\TaskRepositoryInterface;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class TaskController extends Controller
{

    private TaskRepositoryInterface $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }
    
    function index(Request $request) {
        $tasks = $this->taskRepository->index($request);
        $tasks = TaskResource::collection($tasks);
        return response() ->json($tasks, 200, [], JSON_PRETTY_PRINT);
    }

    function show($id)
    {
        $tasks = new TaskResource($this->taskRepository->show($id));
        return response() ->json($tasks, 200, [], JSON_PRETTY_PRINT);
    }

    function store(StoreTaskRequest $request) {
        $request->validated();
        $task = $this->taskRepository->store($request);
        return response() ->json($task, 200, [], JSON_PRETTY_PRINT);
    }

    function destroy($id) {
        $task = $this->taskRepository->destroy($id);
        if(is_null($task)) {
            return response() ->json(['error' => 'Not Found'], 404, [], JSON_PRETTY_PRINT);
        }else {
            return response() ->json($task, 200, [], JSON_PRETTY_PRINT);
        }
    }
    
    function update(Request $request, $id) {
        $task = $this->taskRepository->update($request, $id);
        if(is_null($task)) {
            return response() ->json(['error' => 'Not Found'], 404, [], JSON_PRETTY_PRINT);
        }else {
            return response() ->json($task->fresh(), 200, [], JSON_PRETTY_PRINT);
        }
    }
}
