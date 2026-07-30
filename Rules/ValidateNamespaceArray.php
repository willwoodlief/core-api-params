<?php

namespace App\Data\ApiParams\Rules;


use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidateNamespaceArray implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        static::checkNamespaceRefArray($value,$fail);
    }

    public static function checkNamespaceRefArray(mixed $value, Closure $fail) {
        if (!array($value)) {
            $fail('not an array ');
            return;
        }
        foreach ($value as $something) {
            ValidateNamespaceRef::checkNamespaceRef($something,$fail);
        }
    }

}
