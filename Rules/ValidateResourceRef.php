<?php

namespace App\Data\ApiParams\Rules;


use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Str;

class ValidateResourceRef implements ValidationRule
{
    const int MAX_NAME_LENGTH = 40;
    /**
     * Run the validation rule.
     *
     * @param Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        static::checkResourceName(value: $value,fail: $fail,max_size_name: static::MAX_NAME_LENGTH );
    }

    /**
     * @param Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public static function checkResourceName(mixed $value, Closure $fail,int $max_size_name) {
        if (!is_string($value)) {
            $fail('not a string');
            return;
        }
        if (Str::isUuid($value)) {return;}

        if (!preg_match('/^\p{L}[\p{L}0-9_]{2,}$/', $value) ) {
            $fail('auth.invalid_name')->translate(['limit'=>$max_size_name]);
        }

        if(mb_strlen($value) > static::MAX_NAME_LENGTH) {
            $fail('auth.invalid_name')->translate(['limit'=>$max_size_name]);
        }

        if (static::isUuidSimilar($value) ) {
            $fail('auth.not_uuid_name')->translate();
        }

        if(mb_strtolower($value) !== $value) {
            $fail('auth.not_upper_case_name')->translate();
        }

        if (static::positiveBoolWords($value) || static::negativeBoolWords($value)) {
            $fail('auth.not_reserved_word')->translate();
        }
    }

    public static function isUuidSimilar(?string $guid) : bool{
        if (empty($guid)) {return false;}
        $test_this = str_replace('-','',$guid);
        if (!ctype_xdigit($test_this)) {return false;}
        if (strlen($test_this) < 10) {return false;}
        return true;
    }

    public static function positiveBoolWords($val) : bool {
        return match(mb_strtolower($val)) {
            'yes', '1', 'on', 'true', '' =>true,
            default => false
        };
    }

    public static function negativeBoolWords($val) : bool {
        $val = mb_strtolower($val);
        return match($val) {
            'off', '0', 'no', 'false', '' =>true,
            default => false
        };
    }

}
