<?php

namespace App\DTO\Status;

use App\DTO\BaseDTO;

class IndexDTO extends BaseDTO
{
    public bool $with_closed = false;

    public int $project_id;
}
