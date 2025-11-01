<?php

namespace App\Data\ApiParams\Rules;

use Carbon\Exceptions\InvalidTimeZoneException;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use InvalidArgumentException;

class ValidateCronString implements ValidationRule
{

    /**
     * Run the validation rule.
     *
     * @param Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        try {
            new \Cron\CronExpression($value);
        } catch (InvalidArgumentException) {
            $fail("msg.time_bounds_invalid_cron_string")->translate(['ref'=>$value]);
        }


    }

}
