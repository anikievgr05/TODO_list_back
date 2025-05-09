<?php

namespace App\Services;

use App\DTO\User\FireDTO;
use App\DTO\User\IndexDTO;
use App\DTO\User\ShowDTO;
use App\DTO\User\ShowValidDTO;
use App\DTO\User\StoreDTO;
use App\DTO\User\UpdateDTO;
use App\DTO\User\UpdateRoleDTO;
use App\DTO\User\UsersDTO;
use App\Http\Requests\User\FireAllRequest;
use App\Http\Requests\User\UpdateRoleRequest;
use App\Http\Requests\User\UserRoleDTO;
use App\Repositories\ProjectRepositories;
use App\Repositories\ProjectUserRepositories;
use App\Repositories\RoleRepositories;
use App\Repositories\RoleUserRepositories;
use App\Repositories\UserRepositories;
use App\Repositories\UserRoleRepositories;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public UserRepositories $repository;

    public ProjectRepositories $repository_project;

    public UserRoleRepositories $repository_user_role;

    public function __construct()
    {
        $this->repository = new UserRepositories;
        $this->repository_project = new ProjectRepositories;
        $this->repository_user_role = new UserRoleRepositories;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(IndexDTO $data)
    {
        if ($data->project_id) {
            if (!$data->with_fired) {
                $model = $this->repository_project->all_users($data->project_id);
            } else {
                $model = $this->repository_project->all_users_with_fired($data->project_id);
            }
        } else {
            $model = $this->repository->all();
        }
        $dto = UsersDTO::fromCollection($model, ShowDTO::class, 'users');
        return $dto;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDTO $data): ShowDTO
    {
        $projects_ids = array_column($this->repository_project->all_with_closed()->toArray(), 'id');
        $model = $this->repository->create($data->toArray());
        $this->repository->attachProject($model, $projects_ids);
        $dto = ShowDTO::fromModel($model);
        return $dto;
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowValidDTO $data): ShowDTO
    {
        if (!$data->project_id)
        {
            $model = $this->repository->find($data->user);
        } else {
            $model = $this->repository->find_with_roles($data->user, $data->project_id);
        }

        $dto = ShowDTO::fromModel($model);
        if ($model->projects->isEmpty()) {
            $projects = $this->repository_project->all_with_closed()->toArray();
            $model_projects = [];
            foreach ($projects as $project) {
                $model_projects[] = $project;
            }
            $dto->projects = $model_projects;
        }
        return $dto;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDTO $data): ShowDTO
    {
        $data_update = [
            'name' => $data->name,
            'email' => $data->email,
        ];
        if ($data->password) {
            $data_update['password'] = Hash::make($data->password);
        }
        $model_user = $this->repository->update($data->user, $data_update);
        if ($data->project_id) {
            $repository_role = new RoleUserRepositories();
            if (!$repository_role->userHasRoleInProject($data->user, $data->project_id)) {
                $model_role = $repository_role->create([
                    'user_id' => $data->user,
                    'role_id' => $data->role_id,
                ]);
            } else {
                $model = $repository_role->findUserRoleInProject($data->user, $data->project_id);
                if ($model->role->id != $data->role_id) {
                    $model_role = $repository_role->update($model->id, [
                        'role_id' => $data->role_id,
                    ]);
                }
            }
        }
        if ($data->projects) {
            $model_user = $this->repository->update_project($data->user, $data->projects);
        }
        $dto = ShowDTO::fromModel($model_user);
        return $dto;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function fire(FireDTO $data)
    {
        $project_user_repository = new ProjectUserRepositories();
        $model_project_user = $project_user_repository->find_by_user_id_project_id($data->user,$data->project_id);
        $model = $project_user_repository->update_by_user_id_project_id($data->user, $data->project_id, $data->is_fire);
        return $model;
    }

    public function fire_all(FireAllRequest $data)
    {
        $project_user_repository = new ProjectUserRepositories();
        $model = $project_user_repository->update_in_all_projects_user($data->user, $data->is_fire);
        return $model;
    }

    public function update_role(UpdateRoleDTO $data)
    {
        $old_role = $this->repository->find_with_roles($data->user, $data->project_id);
        if ($old_role->roles->isEmpty()) {
            $old_role = $data->role;
        } else {
            $old_role = $old_role->roles->first()->id;
        }
        $new_data = $this->repository_user_role->update_or_create_role_for_user($data->user, $data->role, $old_role);
        $dto = UserRoleDTO::fromModel($new_data);
        return $dto;
    }
}
