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
}
