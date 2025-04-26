<?php

namespace App\DTO\Project;

use App\DTO\BaseDTO;

class ReadDTO extends BaseDTO
{
    /**
     * @var int
     */
    public int $id;

    /**
     * @var string имя проекта
     */
    public string $name;

    /**
     * @var string описание объекта
     */
    public string $description;

    /**
     * @var bool открыт/зарыт проект
     */
    public bool $is_closed;
}
