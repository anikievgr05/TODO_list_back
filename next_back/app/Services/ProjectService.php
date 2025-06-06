<?php

namespace App\Services;

use App\DTO\Project\CloseDTO;
use App\DTO\Project\CreateDTO;
use App\DTO\Project\GetByNameDTO;
use App\DTO\Project\IndexDTO;
use App\DTO\Project\ReadDTO;
use App\DTO\Project\UpdateDTO;
use App\DTO\ShowDTO;
use App\Http\Requests\Project\GetByNameRequest;
use App\Repositories\ProjectRepositories;
use App\Repositories\UserRepositories;
use Illuminate\Http\Request;

class ProjectService
{
    private ProjectRepositories $repositories;
    private UserRepositories $repositories_users;

    /**
     * Конструктор сервиса.
     *
     * @param ProjectRepositories $repositories
     */
    public function __construct(ProjectRepositories $repositories, UserRepositories $userRepositories)
    {
        $this->repositories = $repositories;
        $this->repositories_users = $userRepositories;
    }

    public function index(): IndexDTO
    {
        $model = $this->repositories->all();
        $dto = IndexDTO::fromCollectionProject($model);
        return $dto;
    }

    public function show(ShowDTO $data): ReadDTO
    {
        $model = $this->repositories->find($data->id);
        $dto = ReadDTO::fromModel($model);
        return $dto;
    }
    /**
     * создаем новый проект
     *
     * @param Request $request
     * @return ReadDTO
     */
    public function create(CreateDTO $data): ReadDTO
    {
        $users = array_column($this->repositories_users->all()->toArray(), 'id');
        $model = $this->repositories->create($data->toArray());
        $this->repositories->attachUser($model, $users);
        $dto = ReadDTO::fromModel($model);
        return $dto;
    }

    public function update(UpdateDTO $data): ReadDTO
    {
        $model = $this->repositories->update($data->id, $data->toArray());
        $dto = ReadDTO::fromModel($model);
        return $dto;
    }

    public function close(CloseDTO $data): ReadDTO
    {
        $model = $this->repositories->update($data->get('id'), $data->toArray());
        $dto = ReadDTO::fromModel($model);
        return $dto;
    }

    public function all_with_closed(): IndexDTO
    {
        $model = $this->repositories->all_with_closed();
        $dto = IndexDTO::fromCollectionProject($model);
        return $dto;
    }

    public function get_by_name(GetByNameDTO $data): ReadDTO
    {
        $model = $this->repositories->get_by_field('name', $data->project);
        $dto = ReadDTO::fromModel($model);
        return $dto;
    }

}
