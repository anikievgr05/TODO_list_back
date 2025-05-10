<?php

namespace App\Repositories;

use App\Models\Task;
use App\Models\TaskFile;
use App\Repositories\BaseRepositories;

class TaskFileRepository extends BaseRepositories
{
    public function __construct()
    {
        $this->model = new TaskFile();
    }
}
