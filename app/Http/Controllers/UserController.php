<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userservice)
    {
        $this->userService = $userservice;
    }

    public function index()
    {
        $users = $this->userService->all();

        return $users;
    }

    public function store(UserRequest $request)
    {
        $userData = $request->only('name','email','password');
        $user = $this->userService->create($userData);
        if ($user) {
            return $user;
        } else {
            return response()->json(['message' => 'error'], 401);
        }
    }
    
    public function update(Request $request, $id)
    {
        $userData = $request->only('name');
        $user = $this->userService->update($id, $userData);
        if ($user) {
            return response()->json(['message' => 'Success'], 200);
        } else {
            return response()->json(['message' => 'error'], 401);
        }
    }

    public function find($id)
    {
        $user =  $this->userService->findById($id);
        if ($user) {
            return $user;
        } else {
            return response()->json(['message' => 'Not found!'], 404);
        }
    }
    
}
