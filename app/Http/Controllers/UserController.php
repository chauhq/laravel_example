<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Http\Resources\UserCollection as ResourcesUserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Event\Code\Throwable;
use App\Repository\Interface\UserRepositoryInterface;

class UserController extends Controller
{

    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) 
    {
     $this->userRepository = $userRepository;
    }

    public function store(RegisterUserRequest $request)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();
        $validated = $request->safe()->only(['uuid']);
        $user = $this->userRepository->store($request);
        return response()->json($user, 200, [], JSON_PRETTY_PRINT);
    }

    public function index()
    {
        $users = $this ->userRepository->index();
        $result = UserResource::collection($users);
        return response()->json(["data" => $result], 200, [], JSON_PRETTY_PRINT);
    }

    public function show($id)
    {
        $user = $this ->userRepository->show($id);
        $result = new UserResource($user) ;
        
        return response()->json($result, 200, [], JSON_PRETTY_PRINT);
    }


    public function destroy($id)
    {
        $user = $this->userRepository->destroy($id);
        if (is_null($user)) {
            return response()->json(['error' => 'Not Found'], 404, [], JSON_PRETTY_PRINT);
        } else {
            return response()->json($user, 200, [], JSON_PRETTY_PRINT);
        }
    }
}
