<?php

namespace App\Rules;

use App\Repositories\BaseRepositories;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckClosed implements ValidationRule
{
    private $repositories;

    private string $searchField;
    public function __construct(BaseRepositories $repositories, string $searchField = 'id'){
        $this->searchField = $searchField;
        $this->repositories = $repositories;
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
            $fail('# Объект заблокирован, сначала его следует разблокировать');
        }
    }
}
