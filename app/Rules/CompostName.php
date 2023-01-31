<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CompostName implements Rule
{
    private $attribute;

//    public function __construct()
//    {
//        $this->attribute = '';
//    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        $this->attribute = $attribute;
        $trimmed = trim($value);
        $numWords = count(explode(' ', $trimmed));
        return $numWords >= 2;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O campo :attribute precisa ter duas ou mais palavras.';
    }
}
