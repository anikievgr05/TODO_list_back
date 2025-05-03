<?php

namespace App\Repositories;

use App\Models\RoleUsers;
use App\Repositories\BaseRepositories;

class RoleUserRepositories extends BaseRepositories
{
     public function __construct()
     {
         $this->model = new RoleUsers();
     }

     public function userHasRoleInProject(int $user_id, int $project_id)
     {
         return $this->model
             ->where('user_id', $user_id)
             ->whereHas('role', function ($query) use ($project_id) {
                 $query->where('project_id', $project_id);
             })
             ->exists();
     }

    public function findUserRoleInProject(int $user_id, int $project_id)
    {
        return $this->model
            ->where('user_id', $user_id)
            ->whereHas('role', function ($query) use ($project_id) {
                $query->where('project_id', $project_id);
            })
            ->with('role')
            ->first();
    }
}
