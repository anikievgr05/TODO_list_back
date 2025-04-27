<?php

namespace App\DTO\Tracker;

use App\DTO\BaseDTO;

class StoreDTO extends BaseDTO
{
    /**
     * @var string имя проекта
     */
    public string $name;

    /**
     * @var string описание объекта
     */
    public string $project_id;
}
