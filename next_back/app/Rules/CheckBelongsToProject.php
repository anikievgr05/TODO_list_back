<?php

namespace App\Rules;

use App\Repositories\BaseRepositories;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Eloquent\Model;

class CheckBelongsToProject implements ValidationRule
{
    private BaseRepositories $repository;

    private int $project_id;

    public function __construct(BaseRepositories $repository, int $project_id)
    {
        $this->repository = $repository;
        $this->project_id = $project_id;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value) {
            $obj = $this->repository->find($value);
            if ($obj->project_id && $obj->project_id != $this->project_id) {
                $fail('Объект не приндалежит проекту');
            }
        }
    }
}
