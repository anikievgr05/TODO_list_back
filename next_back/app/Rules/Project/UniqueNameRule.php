<?php

namespace App\Rules\Project;

use App\Models\Project;
use App\Repositories\ProjectRepositories;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueNameRule implements ValidationRule
{
    private ProjectRepositories $repositories;

    public function __construct(
        private readonly int $id,
    ){
        $this->repositories = new ProjectRepositories;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $project = $this->repositories->get_by_key_excluding_id('name', $value, $this->id);
        if ($project) {
            $fail('# такой проект с таким именем уже существует');
        }
    }
}
