<?php
namespace App\Repository\Interface;

use App\Http\Requests\RegisterUserRequest;

interface UserRepositoryInterface {

    public function index();

    public function show($id);

    public function store(RegisterUserRequest $request);

    public function destroy($id);

}