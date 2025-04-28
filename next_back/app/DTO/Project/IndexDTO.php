<?php

namespace App\DTO\Project;

use App\DTO\BaseDTO;
use Illuminate\Support\Collection;

class IndexDTO extends BaseDTO
{
    /**
     * @var $data
     */
    public array $projects;

    /**
     * преобразуем коллекцию в DTO
     *
     * @param Collection $projects
     * @return self
     */
    public static function fromCollectionProject(Collection $projects): self
    {
        $data = [];
        $data = collect($projects)->map(function ($project) {
            return ReadDTO::fromModel($project);
        })->toArray();
        return new static(['projects' => $data]);
    }
}
