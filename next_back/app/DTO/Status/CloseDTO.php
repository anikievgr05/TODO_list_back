<?php

namespace App\DTO\Status;

use App\DTO\BaseDTO;

class CloseDTO extends BaseDTO
{
    /**
     * @var int ID проекта
     */
    public int $id;

    /**
     * @var bool статус проекта окрыт/закрыт
     */
    public bool $is_closed;
}
