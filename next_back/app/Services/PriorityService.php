<?php

namespace App\Services;

use App\DTO\Priority\ChangeOrderDTO;
use App\DTO\Priority\CloseDTO;
use App\DTO\Priority\IndexDTO;
use App\DTO\Priority\PrioritiesDTO;
use App\DTO\Priority\ShowDTO;
use App\DTO\Priority\ShowValidDTO;
use App\DTO\Priority\StoreDTO;
use App\DTO\Priority\UpdateDTO;
use App\Repositories\PriorityRepositories;

class PriorityService
{

    public PriorityRepositories $repository;

    public function __construct()
    {
        $this->repository = new PriorityRepositories();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(IndexDTO $data): PrioritiesDTO
    {
        if (!$data->with_closed) {
            $model = $this->repository->all_by_parent_open($data->project_id);
        } else {
            $model = $this->repository->all_by_parent($data->project_id, 'project_id');
        }
        $dto = PrioritiesDTO::fromCollection($model, ShowDTO::class, 'priorities');
        return $dto;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDTO $data): ShowDTO
    {
        $lat_order = $this->repository->get_last_by_order($data->project_id)->order ?? 0;
        $data->order = $lat_order + 1;
        $model = $this->repository->create($data->toArray());
        $dto = ShowDTO::fromModel($model);
        return $dto;
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowValidDTO $data): ShowDTO
    {
        $model = $this->repository->find($data->priority);
        $dto = ShowDTO::fromModel($model);
        return $dto;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDTO $data): ShowDTO
    {
        $model = $this->repository->update($data->id, ['name' => $data->name]);
        $dto = ShowDTO::fromModel($model);
        return $dto;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function close(CloseDTO $data): ShowDTO
    {
        $model = $this->repository->update($data->id, $data->toArray());
        $dto = ShowDTO::fromModel($model);
        return $dto;
    }

    public function change_order(ChangeOrderDTO $data): ShowDTO
    {
        $priority = $this->repository->find($data->priority);
        if ($data->action === 'up') {
           $swapWith = $this->repository->all_by_parent_only_open_for_change_order($priority->order, $data->project_id, '<');
        } elseif ($data->action === 'down') {
            $swapWith = $this->repository->all_by_parent_only_open_for_change_order($priority->order, $data->project_id, '>');
        }
        if ($swapWith) {
            $order_this = $priority->order;
            $priority->order = $swapWith->order;
            $swapWith->order = $order_this;
            $priority->save();
            $swapWith->save();
        }
        $dto = ShowDTO::fromModel($priority);
        return $dto;
    }
}
