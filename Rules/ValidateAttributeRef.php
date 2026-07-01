<?php

namespace App\Data\ApiParams\Rules;


use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Str;

class ValidateAttributeRef implements ValidationRule
{
    const int MAX_NAME_LENGTH = 60;
    /**
     * Run the validation rule.
     *
     * @param Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        static::checkAttributeRef(value: $value,fail: $fail );


    }
    public static function checkAttributeRef(mixed $value, Closure $fail) {
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
            $type_hint = $parts[0];
            $attr_name = $parts[1];
            ValidateTypeRef::checkTypeRef($type_hint,$fail);
            ValidateResourceRef::checkResourceName($attr_name,$fail,static::MAX_NAME_LENGTH);
        }
        else if (count($parts) === 3) {
            $namespace_hint = $parts[0];
            $type_hint = $parts[1];
            $attr_name = $parts[2];
            $modified_type_name = $namespace_hint. ValidateNamespaceRef::NAMESPACE_SEPERATOR . $type_hint;

            ValidateTypeRef::checkTypeRef($modified_type_name,$fail);
            ValidateResourceRef::checkResourceName($attr_name,$fail,static::MAX_NAME_LENGTH);
        }
        else if (count($parts) === 4) {
            $namespace_hint = $parts[0];
            $type_hint = $parts[1];
            $attr_name = $parts[2];
            $server_name = $parts[3];

            $modified_type_name = $server_name. ValidateNamespaceRef::NAMESPACE_SEPERATOR .
                $namespace_hint. ValidateNamespaceRef::NAMESPACE_SEPERATOR .
                $type_hint;

            ValidateTypeRef::checkTypeRef($modified_type_name,$fail);
            ValidateResourceRef::checkResourceName($attr_name,$fail,static::MAX_NAME_LENGTH);
        }
        else {
            $fail('auth.too_many_parts_in_a_name');
        }
    }

}
