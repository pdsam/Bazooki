<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidPaymentMethod implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $length = strlen($value);
        if ($length === 16) {
            if (strcmp(substr($value, 0, 1), '4') === 0) {
                return true;
            }

            $initial = intval(substr($value, 0, 2));
            if ($initial >= 51 && $initial <= 55) {
                return true;
            }
            $initial = intval(substr($value, 0, 4));
            if ($initial >= 2221 && $initial <= 2720) {
                return true;
            }
        }
        if ($length >= 12 && $length <= 19) {
            $initial = intval(substr($value, 0, 2));
            if (($initial >= 56 && $initial <= 69) || $initial === 50) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Not a valid card number. Must be Maestro, Visa or MasterCard';
    }
}
