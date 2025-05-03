<?php

namespace App\DTO\User;

use App\DTO\BaseDTO;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class UsersDTO extends BaseDTO
{

    /**
     * @var ShowDTO[]
     */
    public array $users;

    public static function fromCollection(Collection $collection, string $dtoClass, string $propertyName): self
    {
        $data = [];
        $data[$propertyName] = $collection->map(function (Model $item) use ($dtoClass) {
            $dto = $dtoClass::fromModel($item);
            $dto->is_fired = isset($item->pivot->is_fired) ? $item->pivot->is_fired : null;
            return $dto;
        })->toArray();
        return new static($data);
    }
}
