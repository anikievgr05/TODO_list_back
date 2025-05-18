<?php

namespace App\Repositories;

use App\Models\Status;
use Illuminate\Database\Eloquent\Model;

class StatusRepositories extends BaseRepositories
{
    public function __construct()
    {
        $this->model = new Status();
    }

    public function all_by_parent_open(int $project_id)
    {
        return $this->model
            ->where('project_id', $project_id)
            ->where('is_closed', false)
            ->orderBy('order')
            ->get();
    }

    public function get_last_by_order(int $project_id)
    {
        return $this->model
            ->where('project_id', $project_id)
            ->orderBy('order', 'desc')
            ->first();
    }

    public function get_last_by_order_without_closed(int $project_id)
    {
        return $this->model
            ->where('project_id', $project_id)
            ->where('is_closed', false)
            ->orderBy('order', 'desc')
            ->first();
    }

    public function get_first_by_order(int $project_id)
    {
        return $this->model
            ->where('project_id', $project_id)
            ->orderBy('order')
            ->first();
    }
    public function all_by_parent(int $parent_id, string $fill)
    {
        return $this->model
            ->where($fill, $parent_id)
            ->orderBy('order')
            ->get();
    }

    public function all_by_parent_only_open_for_change_order(int $order, int $parent_id, string $sign)
    {
        return $this->model
            ->select('id', 'order')
            ->where('order', $sign, $order)
            ->where('project_id', $parent_id)
            ->orderBy('order', $sign == '>' ? 'asc' : 'desc')
            ->first();
    }

    public function get_project_by_id_status(int $status_id)
    {
        return $this->model
            ->with('project')
            ->find($status_id);
    }

    public function get_next_status(int $project_id, int $status_order)
    {
        return $this->model
            ->where('project_id', $project_id)
            ->where('is_closed', false)
            ->where('order', '>', $status_order)
            ->orderBy('order')
            ->first();
    }
}
