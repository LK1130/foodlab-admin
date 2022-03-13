<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class OnlyDefinedOption implements Rule
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
    /*
    * Create:zayar(2022/01/10) 
    * Update: 
    * This is function is used to check the option value.
    * $value is for user chose option value.
    * Return true when user chose option value is equal to "SA" or "AD" or "KA" or "DL"
    and return false when user chose option value is not equal to "SA" or "AD" or "KA" or "DL".
    */
    public function passes($attribute, $value)
    {
        if (
            $value == "SA" ||
            $value == "AD" ||
            $value == "KA" ||
            $value == "DL"
        ) {
            return true;
        } else return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Only options shown in the box are allowed.";
    }
}
