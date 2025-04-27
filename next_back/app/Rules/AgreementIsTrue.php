<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AgreementIsTrue implements ValidationRule
{
    private bool $checkField;
    public function __construct(bool $checkField = true) {
        $this->checkField = $checkField;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $booleanValue = filter_var($value, FILTER_VALIDATE_BOOLEAN);
        if ($booleanValue !== true && $booleanValue !== false) {
            $fail('# Поле должно быть boolean');
        }
        if ($this->checkField && !$booleanValue) {
            $fail('# Поле должно быть заполнено, если Вы хотите выполнить действие');
        }
    }
}
