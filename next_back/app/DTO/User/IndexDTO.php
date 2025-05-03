<?php

namespace App\DTO\User;

use App\DTO\BaseDTO;

class IndexDTO extends BaseDTO
{
    public bool $with_fired = false;

    public int $project_id = 0;
}
