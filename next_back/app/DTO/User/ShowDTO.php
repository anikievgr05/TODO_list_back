<?php

namespace App\DTO\User;

use App\DTO\BaseDTO;

class ShowDTO extends BaseDTO
{
    public int $id;

    public string $name;

    public string $email;

    public bool | null $is_fired = null;

    public array | null $roles = null;
}
