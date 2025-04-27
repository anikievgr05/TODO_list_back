<?php

namespace App\Services;

use App\DTO\Tracker\IndexDTO;
use App\DTO\Tracker\ShowDTO;
use App\DTO\Tracker\StoreDTO;
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
            $model = $this->repositories->all();
        } else {
            $model = $this->repositories->all_with_closed();
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
}
