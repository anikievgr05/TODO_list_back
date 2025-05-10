<?php

namespace App\Repositories;

use App\Models\Task;
use App\Repositories\BaseRepositories;

class TaskRepository extends BaseRepositories
{
    public function __construct()
    {
        $this->model = new Task();
    }
}
