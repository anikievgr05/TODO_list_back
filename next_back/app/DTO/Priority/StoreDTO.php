<?php

namespace App\DTO\Priority;

use App\DTO\BaseDTO;

class StoreDTO extends BaseDTO
{

    public int $project_id;

    public string $name;

    public string $order = '0';
}
