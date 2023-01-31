<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class BirthdateRule implements Rule
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
        $dateActual = new \DateTime();
        $dateActual->setTime(0,0,0);
        $dateMin = new \DateTime('1900-01-01');
        $dateMin->setTime(0,0,0);
        $dateReceived = new \DateTime($value);
        $dateReceived->setTime(0,0,0);
        return $dateReceived->getTimestamp() >= $dateMin->getTimestamp() && $dateReceived->getTimestamp() <= $dateActual->getTimestamp();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be equal or more than 1900 and equal or less than '.date('Y-m-d').'.';
    }
}