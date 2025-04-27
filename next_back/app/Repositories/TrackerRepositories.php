<?php

namespace App\Repositories;

use App\Models\Tracker;

class TrackerRepositories extends BaseRepositories
{
    public function __construct()
    {
        $this->model = new Tracker;
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
