<?php

namespace App\Data\ApiParams\Rules;


use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidateNamespaceRef implements ValidationRule
{
    const int MAX_NAME_LENGTH = 30;

    const NAMESPACE_SEPERATOR = ':';
    /**
     * Run the validation rule.
     *
     * @param Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        static::checkNamespaceRef(value: $value,fail: $fail );


    }
    public static function checkNamespaceRef(mixed $value, Closure $fail) {
        ValidateResourceRef::checkResourceName($value,$fail,static::MAX_NAME_LENGTH);
    }

}
