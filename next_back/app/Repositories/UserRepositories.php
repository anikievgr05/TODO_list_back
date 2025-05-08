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
            ->with('projects')
            ->first();
    }

    public function attachProject(User $user, array $projectIds)
    {
        $user->projects()->attach($projectIds);
        return true;
    }

    public function update_project(int $id, array $project)
    {
        $user = $this->model
            ->where('id', $id)
            ->with('projects')
            ->first();
        $user->projects()->detach();
        $attachData = [];
        foreach ($project as $project_id => $is_fired) {
            $attachData[$project_id] = [
                'is_fired' => (bool)$is_fired,
            ];
        }
        if (!empty($attachData)) {
            $user->projects()->attach($attachData);
        }
        return $user;
    }
}
