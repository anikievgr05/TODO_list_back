<?php

namespace App\Repositories;

use App\Models\Tracker;

class TrackerRepositories extends BaseRepositories
{
    public function __construct()
    {
        $this->model = new Tracker;
    }

    public function all_by_parent(int $parent_id, string $fill = 'project_id')
    {
        return $this->model
            ->where($fill, $parent_id)
            ->where('is_closed', false)
            ->get();
    }

    public function all_with_closed(int $parent_id)
    {
        return $this->model
            ->where('project_id', $parent_id)
            ->get();
    }
    public function get_project_by_id_tracker(int $tracker_id)
    {
        return $this->model
            ->with('project')
            ->find($tracker_id);
    }
}
