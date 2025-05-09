<?php

namespace App\DTO\Priority;

use App\DTO\BaseDTO;

class ChangeOrderDTO extends BaseDTO
{
    public int $priority;

    public int $project_id;
    public string $action;
}
