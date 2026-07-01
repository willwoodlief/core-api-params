<?php

namespace App\Data\ApiParams\Rules;


use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Str;

class ValidateTypeRef implements ValidationRule
{
    const int MAX_NAME_LENGTH = 60;
    /**
     * Run the validation rule.
     *
     * @param Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        static::checkTypeRef(value: $value,fail: $fail );
    }

    public static function checkTypeRef(mixed $value, Closure $fail) {
        if (!is_string($value)) {
            $fail('not a string');
            return;
        }
        if (Str::isUuid($value)) {return;}



        $parts = explode(ValidateNamespaceRef::NAMESPACE_SEPERATOR, $value);
        if (count($parts) === 1) {
            ValidateResourceRef::checkResourceName($value,$fail,static::MAX_NAME_LENGTH);
        }
        else if (count($parts) === 2) {
            $namespace_hint = $parts[0];
            $type_name = $parts[1];
            ValidateNamespaceRef::checkNamespaceRef($namespace_hint,$fail);
            ValidateResourceRef::checkResourceName($type_name,$fail,static::MAX_NAME_LENGTH);
        }else if (count($parts) === 3) {
            $namespace_hint = $parts[0];
            $type_name = $parts[1];
            $server_name = $parts[2];
            ValidateNamespaceRef::checkNamespaceRef($namespace_hint,$fail);
            ValidateResourceRef::checkResourceName($type_name,$fail,static::MAX_NAME_LENGTH);
            ValidateResourceRef::checkResourceName($server_name,$fail,static::MAX_NAME_LENGTH);
        }
        else {
            $fail('auth.too_many_parts_in_a_name');
        }
    }

}
