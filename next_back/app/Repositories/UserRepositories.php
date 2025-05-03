<?php

namespace App\Repositories;

use App\Models\Project;
use App\Models\User;

class UserRepositories extends BaseRepositories
{
    public function __construct()
    {
        $this->model = new User;
    }

    public function find($id)
    {
        return $this->model
            ->where('id', $id)
            ->with('roles')
            ->first();
    }
}
