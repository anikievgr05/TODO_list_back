<?php

namespace App\Rules;

use App\Repositories\BaseRepositories;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueNameByProjectId implements ValidationRule
{
    private int $id;
    private BaseRepositories $repository;

    private int $project_id;

    public function __construct(int $id, int $project_id, BaseRepositories $repository) {
        $this->id = $id;
        $this->project_id = $project_id;
        $this->repositories = $repository;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $obj = $this->repositories->get_by_key_excluding_id_in_parent('name', $value, $this->id, 'project_id', $this->project_id);
        if ($obj) {
            $fail('# Объект с таким именем уже существует');
        }
    }
}
