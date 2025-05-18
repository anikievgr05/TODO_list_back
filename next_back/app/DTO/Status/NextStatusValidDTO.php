<?php

namespace App\DTO\Status;

use App\DTO\BaseDTO;

class NextStatusValidDTO extends BaseDTO
{
    public int $project_id;

    public int $status;
}
