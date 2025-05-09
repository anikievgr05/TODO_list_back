<?php

namespace App\DTO\Priority;

use App\DTO\BaseDTO;

class ShowValidDTO extends BaseDTO
{
    public int $priority;

    public bool $with_closed = false;
}
