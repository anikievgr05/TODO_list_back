<?php

namespace App\Repositories;

use App\DTO\Task\IndexDTO;
use App\Models\Task;
use App\Repositories\BaseRepositories;

class TaskRepository extends BaseRepositories
{
    public function __construct()
    {
        $this->model = new Task();
    }

    public function get_tasks(IndexDTO $dto){
        $last_status = (new StatusRepositories())->get_last_by_order_without_closed($dto->project_id);
        $query = $this->model->query();
        $query->where('responsible_id', $dto->responsible_id);
        $query->where('project_id', $dto->project_id);
        $query->where('is_closed', $dto->is_closed);
        if (!is_null($dto->priority_id)) {
            $query->where('priority_id', $dto->priority_id);
        }
        if (!is_null($dto->status_id)) {
            $query->where('status_id', $dto->status_id);
        }
        if (!is_null($dto->tracker_id)) {
            $query->where('tracker_id', $dto->tracker_id);
        }
        $query->where(function ($q) use ($last_status) {
            $q->where('status_id', '!=', $last_status->id);
        });
        $query->with('priority', 'status', 'tracker', 'responsible', 'reviewer', 'author', 'files');
        if ($dto->order_by_field) {
            $query->orderBy($dto->order_by_field, $dto->order_by_method ?? 'asc');
        }
        return $query->paginate(50, ['*'], 'page', $dto->page);
    }
}
