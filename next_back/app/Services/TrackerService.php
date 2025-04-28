<?php

namespace App\Services;

use App\DTO\Tracker\CloseDTO;
use App\DTO\Tracker\IndexDTO;
use App\DTO\Tracker\ShowDTO;
use App\DTO\Tracker\StoreDTO;
use App\DTO\Tracker\UpdateDTO;
use App\Repositories\TrackerRepositories;

class TrackerService
{
    private TrackerRepositories $repositories;

    /**
     * Конструктор сервиса.
     *
     */
    public function __construct()
    {
        $this->repositories = new TrackerRepositories;
    }

    public function index($data): IndexDTO
    {
        if (!isset($data['with_closed']) || !$data['with_closed']) {
            $model = $this->repositories->all_by_parent($data['project_id']);
        } else {
            $model = $this->repositories->all_with_closed($data['project_id']);
        }
        $dto = IndexDTO::fromCollection($model);
        return $dto;
    }

    public function create(StoreDTO $data): ShowDTO
    {
        $model = $this->repositories->create($data->toArray());
        $dto = ShowDTO::fromModel($model);
        return $dto;
    }

    public function show(ShowDTO $dto): ShowDTO
    {
        $model = $this->repositories->find($dto->tracker);
        $dto = ShowDTO::fromModel($model);
        return $dto;
    }

    public function update(UpdateDTO $data): ShowDTO
    {
        $model = $this->repositories->update($data->id, ['name' => $data->name]);
        $dto = ShowDTO::fromModel($model);
        return $dto;
    }

    public function close(CloseDTO $data): ShowDTO
    {
        $model = $this->repositories->update($data->id, $data->toArray());
        $dto = ShowDTO::fromModel($model);
        return $dto;
    }
}
