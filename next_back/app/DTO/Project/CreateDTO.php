<?php

namespace App\DTO\Project;

use App\DTO\BaseDTO;

class CreateDTO extends BaseDTO
{
    /**
     * @var string имя проекта
     */
    public string $name;

    /**
     * @var string описание объекта
     */
    public string $description;

}
