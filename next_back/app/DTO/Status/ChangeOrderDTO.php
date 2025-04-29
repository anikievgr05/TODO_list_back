<?php

namespace App\DTO\Status;

use App\DTO\BaseDTO;

class ChangeOrderDTO extends BaseDTO
{
    public int $status;

    public int $project_id;
    public string $action;
}
