<?php

namespace App\Rules\Project;

use App\Repositories\ProjectRepositories;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckClose implements ValidationRule
{
    private ProjectRepositories $repositories;

    private string $searchField;
    public function __construct(string $searchField = 'id'){
        $this->searchField = $searchField;
        $this->repositories = new ProjectRepositories;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $model = $this->repositories->get_by_field($this->searchField, $value);
        if ($model->is_closed) {
            $fail('# Проект заблокирован, сначала его следует разблокировать');
        }
    }
}
