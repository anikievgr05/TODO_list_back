<?php

namespace App\Repositories;

use App\Models\ProjectUser;
use App\Repositories\BaseRepositories;

class ProjectUserRepositories extends BaseRepositories
{
    public function __construct()
    {
        $this->model = new ProjectUser();
    }

    public function find_by_user_id(int $user_id)
    {
        return $this->model
            ->where('user_id', $user_id)
            ->first();
    }

    public function find_by_user_id_project_id(int $user_id, int $project_id)
    {
        return $this->model
            ->where('user_id', $user_id)
            ->where('project_id', $project_id)
            ->first();
    }

    public function update_by_user_id_project_id(int $user_id, int $project_id, bool $is_fire) {
        return $this->model
            ->where('user_id', $user_id)
            ->where('project_id', $project_id)
            ->update(['is_fired' => $is_fire]);
    }

    public function update_in_all_projects_user(int $user_id, bool $is_fire) {
        return $this->model
            ->where('user_id', $user_id)
            ->update(['is_fired' => $is_fire]);
    }
}
