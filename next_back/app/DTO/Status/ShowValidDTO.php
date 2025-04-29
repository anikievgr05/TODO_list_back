<?php

namespace App\DTO\Status;

use App\DTO\BaseDTO;

class ShowValidDTO extends BaseDTO
{
    public int $status;

    public bool $with_closed = false;
}
