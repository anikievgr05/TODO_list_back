<?php

namespace App\DTO\Role;

use App\DTO\BaseDTO;

class ShowDTO extends BaseDTO
{

    public int $id;

    public string $name;

    public int $project_id;

    public bool $is_closed;
}
