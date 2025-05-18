<?php

namespace App\DTO\Task;

use App\DTO\BaseDTO;

class TaskDTO extends BaseDTO
{
    public int $id;

    public string $brief_description;

    public string | null $date_end = null;

    public array $priority;

    public array $status;

    public array $tracker;

    public array | null $responsible;

    public array | null $reviewer;

    public array $author;

    public array $files;
}
