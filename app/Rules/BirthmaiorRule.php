<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class BirthmaiorRule implements Rule
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

        return calculaIdade($value) >= 18;
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