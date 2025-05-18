<?php

namespace App\Services;

use App\DTO\Task\CreateDTO;
use App\DTO\Task\IndexDTO;
use App\DTO\Task\ShowDTO;
use App\DTO\Task\ShowValidDTO;
use App\DTO\Task\TaskDTO;
use App\DTO\Task\TasksDTO;
use App\DTO\Task\UpdateDTO;
use App\Models\TaskFile;
use App\Repositories\StatusRepositories;
use App\Repositories\TaskFileRepository;
use App\Repositories\TaskRepository;
use Illuminate\Support\Facades\Storage;

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
                // Генерируем имя файла
                $originalName = $file->getClientOriginalName();

                // Путь для хранения
                $filePath = "tasks/{$task->id}/" . $originalName;

                // Проверяем, существует ли файл с таким именем
                if (!Storage::disk('public')->exists($filePath)) {
                    // Сохраняем файл только если он не существует
                    $path = $file->storeAs("tasks/{$task->id}", $originalName, 'public');

                    // Создаем запись в БД
                    $this->repository_file->create([
                        'task_id' => $task->id,
                        'file_path' => $path,
                        'name' => $originalName
                    ]);
                }
            }
        }
        $dto = ShowDTO::fromModel($task);
        return $dto;
    }

    public function show(ShowValidDTO $dto)
    {
        $model = $this->repository->find($dto->id);
        $dto = ShowDTO::fromModel($model);
        return $dto;
    }

    public function get_file($file)
    {
        $repository_file = new TaskFileRepository();
        $path = $repository_file->find($file)->file_path;
        return Storage::disk('public')->path($path);
    }
    public function delete_file($file)
    {
        $repository_file = new TaskFileRepository();
        $file = $repository_file->find($file);
        if (Storage::disk('public')->exists($file->file_path)) {
            Storage::disk('public')->delete($file->file_path);
            $file->delete();
        }
        return $file;
    }

    public function change_status(ShowValidDTO $data)
    {
        $repository_status = new StatusRepositories();
        $model = $this->repository->find($data->id);
        $next_status = $repository_status->get_next_status($model->project_id, $model->status->order);
        $data = $this->repository->update($data->id, ['status_id' =>  $next_status->id]);
        return ShowDTO::fromModel($data);
    }

    public function update(UpdateDTO $data)
    {
        $model = $this->repository->update($data->task, [
            'brief_description'=> $data->brief_description,
            'tracker_id' => $data->tracker_id,
            'priority_id' => $data->priority_id,
            'status_id' => $data->status_id,
            'responsible_id' => $data->responsible_id,
            'reviewer_id' => $data->reviewer_id,
            'date_end' => $data->date_end
        ]);
        if (!empty($data->tz)) {
            foreach ($data->tz as $file) {
                // Генерируем имя файла
                $originalName = $file->getClientOriginalName();

                // Путь для хранения
                $filePath = "tasks/{$model->id}/" . $originalName;

                // Проверяем, существует ли файл с таким именем
                if (!Storage::disk('public')->exists($filePath)) {
                    // Сохраняем файл только если он не существует
                    $path = $file->storeAs("tasks/{$model->id}", $originalName, 'public');

                    // Создаем запись в БД
                    $this->repository_file->create([
                        'task_id' => $model->id,
                        'file_path' => $path,
                        'name' => $originalName
                    ]);
                }
            }
        }
        $dto = ShowDTO::fromModel($model);
        return $dto;
    }
}
