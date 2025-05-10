<?php

namespace App\Services;

use App\DTO\Task\CreateDTO;
use App\DTO\Task\IndexDTO;
use App\DTO\Task\ShowDTO;
use App\DTO\Task\TaskDTO;
use App\DTO\Task\TasksDTO;
use App\Models\TaskFile;
use App\Repositories\StatusRepositories;
use App\Repositories\TaskFileRepository;
use App\Repositories\TaskRepository;

class TaskService
{
    private TaskRepository $repository;

    private TaskFileRepository $repository_file;

    private StatusRepositories $repository_status;

    public function __construct()
    {
        $this->repository = new TaskRepository;
        $this->repository_file = new TaskFileRepository;
        $this->repository_status = new StatusRepositories();
    }

    public function index(IndexDTO $data)
    {
        if (!$data->responsible_id) {
            $data->responsible_id = auth()->id();
        }
        $model = $this->repository->get_tasks($data);
        $dto = TasksDTO::fromCollection($model->collect(), TaskDTO::class, 'tasks');
        $dto->currentPage = $model->currentPage();
        $dto->lastPage = $model->lastPage();
        return $dto;
    }

    public function create(CreateDTO $data)
    {

        $task = $this->repository->create([
            'brief_description' => $data->brief_description,
            'project_id' => $data->project_id,
            'tracker_id' => $data->tracker_id,
            'priority_id' => $data->priority_id,
            'status_id' => $this->repository_status->get_first_by_order($data->project_id)->id,
            'responsible_id' => $data->responsible_id,
            'reviewer_id' => $data->reviewer_id,
            'date_end' => $data->date_end,
            'author_id' => auth()->id()
        ]);
        if (!empty($data->tz)) {
            foreach ($data->tz as $file) {
                // Путь для хранения
                $path = $file->store('tasks', 'public');
                $this->repository_file->create([
                    'task_id' => $task->id,
                    'file_path' => $path,
                    'name' => $file->getClientOriginalName()
                ]);
            }
        }
        $dto = ShowDTO::fromModel($task);
        return $dto;
    }
}
