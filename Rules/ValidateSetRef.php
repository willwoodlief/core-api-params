<?php

namespace App\Data\ApiParams\Rules;


use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Str;

class ValidateSetRef implements ValidationRule
{

    /**
     * Run the validation rule.
     *
     * @param Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        static::checkSetRef(value: $value,fail: $fail );
    }

    public static function checkSetRef(mixed $value, Closure $fail) {
        if (!is_string($value)) {
            $fail('not a string');
            return;
        }
        if (Str::isUuid($value)) {return;}



        $fail('auth.not_a_uuid')->translate(['limit'=>$value]);
    }

}
