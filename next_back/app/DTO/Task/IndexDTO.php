<?php

namespace App\DTO\Task;

use App\DTO\BaseDTO;

class IndexDTO extends BaseDTO
{
    public int $project_id;

    public int | null $responsible_id = null;

    public int | null $priority_id = null;

    public int | null $status_id = null;

    public int | null $tracker_id= null;

    public string | null $order_by_field = null;

    public string | null $order_by_method = null;

    public int $page = 1;

    public string | null $date = null;

    public bool $is_closed = false;
}
