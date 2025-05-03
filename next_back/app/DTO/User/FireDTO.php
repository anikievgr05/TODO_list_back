<?php

namespace App\DTO\User;

use App\DTO\BaseDTO;

class FireDTO extends BaseDTO
{
    public int $user;

    public int | null $project_id = null;

    public bool $is_fire = false;
}
