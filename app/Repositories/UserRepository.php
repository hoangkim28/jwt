<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function create($attributes)
    {
        return $this->user->create($attributes);
    }
    
    public function list_user()
    {
        return $this->user->all();
    }

    public function update($id, $attributes)
    {
        return $this->user->where('id',$id)->update($attributes);
    }

    public function find($id)
    {
        return $this->user->find($id);
    }
    
}
