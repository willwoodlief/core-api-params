<?php

namespace App\Data\ApiParams\Rules;


use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidateAttributeArray implements ValidationRule
{
    const int MAX_NAME_LENGTH = 40;
    /**
     * Run the validation rule.
     *
     * @param Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        static::checkAttributeRefArray($value,$fail);
    }

    public static function checkAttributeRefArray(mixed $value, Closure $fail) {
        if (!array($value)) {
            $fail('not an array ');
            return;
        }

        foreach ($value as $something) {
            ValidateAttributeRef::checkAttributeRef($something,$fail);
        }
    }

}
