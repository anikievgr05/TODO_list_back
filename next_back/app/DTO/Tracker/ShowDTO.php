<?php

namespace App\DTO\Tracker;

use App\DTO\BaseDTO;

class ShowDTO extends BaseDTO
{
    /**
     * @var int
     */
    public int $id;

    /**
     * @var string имя трекера
     */
    public string $name;

    /**
     * @var int ID проекта к которому принадлежит трекер
     */
    public int $project_id;

    /**
     * @var bool открыт/зарыт трекер
     */
    public bool $is_closed;
}
