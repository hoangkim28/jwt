<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;

class UserService
{
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create($attributes)
    {
        $user = $this->userRepository->create($attributes);
        return $user;
    }

    public function all()
    {
        return $this->userRepository->list_user();
    }

    public function update($id,$request)
    {
        // $user = $this->userRepository->find($id);
        $user = $this->userRepository->update($id,$request);
        return $user;
    }

    public function findById($id)
    {
        return $this->userRepository->find($id);
    }
}

