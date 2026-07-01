<?php

namespace App\Data\ApiParams\Rules;


use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidatePhaseRef implements ValidationRule
{
    const int MAX_NAME_LENGTH = 128;

    /**
     * Run the validation rule.
     *
     * @param Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        static::checkPhaseRef(value: $value,fail: $fail );


    }
    public static function checkPhaseRef(mixed $value, Closure $fail) {
        ValidateResourceRef::checkResourceName($value,$fail,static::MAX_NAME_LENGTH);
    }

}
