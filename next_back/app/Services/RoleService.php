<?php

namespace App\Services;

use App\DTO\Role\CloseDTO;
use App\DTO\Role\IndexDTO;
use App\DTO\Role\RolesDTO;
use App\DTO\Role\ShowDTO;
use App\DTO\Role\ShowValidDTO;
use App\DTO\Role\StoreDTO;
use App\DTO\Role\UpdateDTO;
use App\Repositories\RoleRepositories;

class RoleService
{

    public RoleRepositories $repository;

    public function __construct()
    {
        $this->repository = new RoleRepositories();
    }

    public function index(IndexDTO $data)
    {
        if (!$data->with_closed) {
            $model = $this->repository->all_by_parent_open($data->project_id);
        } else {
            $model = $this->repository->all_by_parent($data->project_id, 'project_id');
        }
        $dto = RolesDTO::fromCollection($model, ShowDTO::class, 'roles');
        return $dto;
    }

    public function store(StoreDTO $data): ShowDTO
    {
        $model = $this->repository->create($data->toArray());
        $dto = ShowDTO::fromModel($model);
        return $dto;
    }

    public function show(ShowValidDTO $data)
    {
        $model = $this->repository->find($data->role);
        $dto = ShowDTO::fromModel($model);
        return $dto;
    }

    public function update(UpdateDTO $data)
    {
        $model = $this->repository->update($data->id, ['name' => $data->name]);
        $dto = ShowDTO::fromModel($model);
        return $dto;
    }

    public function close(CloseDTO $data)
    {
        $model = $this->repository->update($data->id, $data->toArray());
        $dto = ShowDTO::fromModel($model);
        return $dto;
    }
}
