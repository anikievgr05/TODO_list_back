<?php

namespace App\Services;

use App\DTO\Status\ChangeOrderDTO;
use App\DTO\Status\CloseDTO;
use App\DTO\Status\IndexDTO;
use App\DTO\Status\ShowDTO;
use App\DTO\Status\ShowValidDTO;
use App\DTO\Status\StatusesDTO;
use App\DTO\Status\StoreDTO;
use App\DTO\Status\UpdateDTO;
use App\Repositories\StatusRepositories;
use Illuminate\Http\JsonResponse;

class StatusService
{

    public StatusRepositories $repository;

    public function __construct()
    {
        $this->repository = new StatusRepositories();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(IndexDTO $data): StatusesDTO
    {
        if (!$data->with_closed) {
            $model = $this->repository->all_by_parent_open($data->project_id);
        } else {
            $model = $this->repository->all_by_parent($data->project_id, 'project_id');
        }
        $dto = StatusesDTO::fromCollection($model, ShowDTO::class, 'statuses');
        return $dto;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDTO $data): ShowDTO
    {
        $lat_order = $this->repository->get_last_by_order($data->project_id)->order;
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
        $model = $this->repository->find($data->status);
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
        $status = $this->repository->find($data->status);
        if ($data->action === 'up') {
           $swapWith = $this->repository->all_by_parent_only_open_for_change_order($status->order, $data->project_id, '<');
        } elseif ($data->action === 'down') {
            $swapWith = $this->repository->all_by_parent_only_open_for_change_order($status->order, $data->project_id, '>');
        }
        if ($swapWith) {
            $order_this = $status->order;
            $status->order = $swapWith->order;
            $swapWith->order = $order_this;
            $status->save();
            $swapWith->save();
        }
        $dto = ShowDTO::fromModel($status);
        return $dto;
    }
}
