<?php

namespace App\Repositories;

use App\Models\Project;

class ProjectRepositories extends BaseRepositories
{
    public function __construct(Project $project)
    {
        $this->model = $project;
    }
}
