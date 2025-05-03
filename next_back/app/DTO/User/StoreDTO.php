<?php

namespace App\DTO\User;

use App\DTO\BaseDTO;

class StoreDTO extends BaseDTO
{
    public string $name;

    public string $email;

    public string $password;
}
