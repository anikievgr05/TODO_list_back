<?php

namespace App\DTO\User;

use App\DTO\BaseDTO;

class UpdateRoleDTO extends BaseDTO
{
    public int $user;

    public int $role;

    public int $project_id;
}
