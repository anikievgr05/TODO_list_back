<?php

namespace App\DTO\Tracker;

use App\DTO\BaseDTO;

class UpdateDTO extends BaseDTO
{
    /**
     * @var int Id трекера
     */
    public int $id;

    /**
     * @var string Имя трекера
     */
    public string $name;
}
