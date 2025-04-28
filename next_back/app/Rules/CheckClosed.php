<?php

namespace App\Rules;

use App\Repositories\BaseRepositories;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckClosed implements ValidationRule
{
    private BaseRepositories $repositories;

    private bool $with_closed;

    private string $searchField;
    public function __construct(BaseRepositories $repositories, bool $with_closed = false, string $searchField = 'id'){
        $this->searchField = $searchField;
        $this->repositories = $repositories;
        $this->with_closed = $with_closed;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->with_closed) {
            $model = $this->repositories->get_by_field($this->searchField, $value);
            if ($model->is_closed) {
                $fail('# Объект заблокирован, сначала его следует разблокировать');
            }
        }
    }
}
