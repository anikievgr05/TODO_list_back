<?php

namespace App\DTO\Tracker;

use App\DTO\BaseDTO;
use Illuminate\Support\Collection;

class IndexDTO extends BaseDTO
{
    /** @var ShowDTO[] */
    public array $trackers;

    public static function fromCollection(Collection $projects): self
    {
        $data = [];
        $data = collect($projects)->map(function ($project) {
            return ShowDTO::fromModel($project);
        })->toArray();
        return new static(['trackers' => $data]);
    }
}
