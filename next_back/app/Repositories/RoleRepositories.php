<?php

namespace App\Repositories;

use App\Models\Role;

class RoleRepositories extends BaseRepositories
{
    public function __construct()
    {
        $this->model = new Role;
    }
    public function all_by_parent_open(int $project_id)
    {
        return $this->model
            ->where('project_id', $project_id)
            ->where('is_closed', false)
            ->get();
    }
    public function get_project_by_id_status(int $role_id)
    {
        return $this->model
            ->with('project')
            ->find($role_id);
    }

    
}
