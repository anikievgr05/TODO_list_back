<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AgreementIsTrue implements ValidationRule
{
    private bool $checkField;
    public function __construct(mixed $checkField = '') {
        $this->checkField = (bool)$checkField;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->checkField && !$value) {
            $fail('# Поле должно быть заполнено, если Вы хотите выполнить действие');
        }
    }
}
