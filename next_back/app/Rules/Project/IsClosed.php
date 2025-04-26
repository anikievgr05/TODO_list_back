<?php

namespace App\Rules\Project;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class IsClosed implements ValidationRule
{
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
    }
}
