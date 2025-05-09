<?php

namespace App\DTO\Priority;

use App\DTO\BaseDTO;

class IndexDTO extends BaseDTO
{
    public bool $with_closed = false;

    public int $project_id;
}
