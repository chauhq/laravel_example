<?php
namespace App\Repository;

use App\Http\Requests\RegisterUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repository\Interface\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface {

    public function index()
    {
        return User::all();
    }

    public function show($id)
    {
        return User::with('tasks')->find($id);
          
    }

    public function store(RegisterUserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->uuid = $request->uuid;
        $user->save();
        return $user->fresh();
    }

    public function destroy($id) {
        $user = User::find($id);
        if (!is_null($user)) {
            $user->delete();
        }
        return $user;
    }

}
