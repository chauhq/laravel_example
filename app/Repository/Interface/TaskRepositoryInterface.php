<?php
namespace App\Repository\Interface;

use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\StoreTaskRequest;
use Illuminate\Http\Request;

interface TaskRepositoryInterface {

    public function index(Request $request);

    public function show($id);

    public function store(StoreTaskRequest $request);

    public function destroy($id);

    public function update(Request $request, $id);

}