<?php

namespace App\DTO\Task;

use App\DTO\BaseDTO;

class CreateDTO extends BaseDTO
{
    public string $brief_description;

    public int $project_id;

    public int $author_id;

    public int | null $responsible_id = null;

    public int | null $reviewer_id = null;

    public int $tracker_id;

    public int $priority_id;

    public string | null $date_end;

    public array $tz;
}
