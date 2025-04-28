<?php

namespace App\DTO\Role;

use App\DTO\BaseDTO;

class ShowValidDTO extends BaseDTO
{
    public int $role;

    public bool $with_closed = false;
}
