<?php

namespace App\DTO\User;

use App\DTO\BaseDTO;

class UpdateDTO extends BaseDTO
{
    public int $user;

    public int $role_id;

    public int | null $project_id = null;

    public string $name;

    public string $email;

    public string | null $password = null;
}
