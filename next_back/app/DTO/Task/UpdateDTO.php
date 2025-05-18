<?php

namespace App\DTO\Task;

use App\DTO\BaseDTO;

class UpdateDTO extends BaseDTO
{
    public int $task;

    /**
     * @var string
     */
    public string $brief_description;

    /**
     * @var int
     */
    public int $project_id;

    /**
     * @var int
     */
    public int $tracker_id;

    /**
     * @var int
     */
    public int $priority_id;

    /**
     * @var int|null
     */
    public ?int $responsible_id = null;

    /**
     * @var string|null
     */
    public ?string $date_end = null;

    /**
     * @var int|null
     */
    public int $status_id;

    public ?int $reviewer_id = null;

    public array $tz;

}
