<?php

namespace App\DTO\User;

use App\DTO\BaseDTO;

class UpdateDTO extends BaseDTO
{
    public int $user;

    public int $role_id;

    public int $project_id;

    public string $name;

    public string $email;

}
