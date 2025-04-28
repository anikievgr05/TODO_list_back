<?php

namespace App\Rules;

use App\Repositories\BaseRepositories;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueName implements ValidationRule
{
    private int $id;
    private BaseRepositories $repository;
    public function __construct(int $id, BaseRepositories $repository) {
        $this->id = $id;
        $this->repositories = $repository;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $obj = $this->repositories->get_by_key_excluding_id('name', $value, $this->id);
        if ($obj) {
            $fail('# Объект с таким именем уже существует');
        }
    }
}
