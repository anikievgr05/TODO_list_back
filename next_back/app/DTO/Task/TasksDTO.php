<?php

namespace App\DTO\Task;

use App\DTO\BaseDTO;

class TasksDTO extends BaseDTO
{
    /**
     * @var TaskDTO[]
     */
    public array $tasks;

    public int $currentPage = 1;

    public int $lastPage = 1;
}
