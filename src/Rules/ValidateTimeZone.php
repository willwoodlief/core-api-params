<?php

namespace App\Rules;

use Carbon\Carbon;
use Carbon\Exceptions\InvalidTimeZoneException;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidateTimeZone implements ValidationRule
{

    /**
     * Run the validation rule.
     *
     * @param Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        try {
            Carbon::now()->setTimezone($value);
        } catch (InvalidTimeZoneException $e) {
            $fail("msg.invalid_time_zone")->translate(['ref'=>$value]);
        }


    }

}
