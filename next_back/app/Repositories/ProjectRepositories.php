<?php

namespace App\Repositories;

use App\Models\Project;
use App\Services\ProjectService;

class ProjectRepositories extends BaseRepositories
{
    public function __construct()
    {
        $this->model = new Project;
    }
    public function all()
    {
        return $this->model
            ->where('is_closed', false)
            ->get();
    }

    public function all_with_closed()
    {
        return $this->model->all();
    }

    public function all_users($id)
    {
        $data = $this->model
            ->where('id', $id)
            ->with(['users' => function ($query) {
                $query->wherePivot('is_fired', false);
            }])
            ->first();
        return $data->users;
    }

    public function all_users_with_fired($id)
    {
        $data = $this->model
            ->where('id', $id)
            ->with('users')
            ->first();
        return $data->users;
    }
    public function attachUser(Project $project, array $users_ids)
    {
        $project->users()->attach($users_ids);
        return true;
    }
}
