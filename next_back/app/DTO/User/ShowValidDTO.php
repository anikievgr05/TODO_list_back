<?php

namespace App\DTO\User;

use App\DTO\BaseDTO;

class ShowValidDTO extends BaseDTO
{
    public int $user;

    public int | null $project_id = null;
}
