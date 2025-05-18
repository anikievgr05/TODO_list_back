<?php

namespace App\DTO\Task;

use App\DTO\BaseDTO;
use App\DTO\Project\ReadDTO;

class ShowDTO extends BaseDTO
{
    public int $id;

    public string $brief_description;

    public int $project_id;

    public int $author_id;

    public int | null $responsible_id = null;

    public int | null $reviewer_id = null;

    public int $tracker_id;

    public int $status_id;

    public int $priority_id;

    public string | null $date_end;

    public array $project;
    public array $status;
    public array $tracker;
    public array | null $responsible;
    public array | null $reviewer;
    public array $author;
    public array $files;
    public array $priority;

}
