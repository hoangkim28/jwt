<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
  
        return $users;
    }

    public function store(Request $request)
    {
        $userData = $request->all();
        $user = User::create($userData);
        if($user)
        return $user;
        else
        return response()->json(['message' => 'error'], 401);
    }
}
