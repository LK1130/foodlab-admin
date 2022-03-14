<?php

namespace App\Rules;

use App\Models\M_AD_Login;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Log;

class AdminUsernameRule implements Rule
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
        Log::channel('adminlog')->info('AdminUsernameRule', [
            'start passes'
        ]);

        $username = new M_AD_Login();
        $hasName = $username->checkUsernamae($value);

        if (count($hasName) > 0) {
            session(['name' => $hasName[0]['ad_name']]);

            Log::channel('adminlog')->info('AdminUsernameRule', [
                'end passes'
            ]);

            return true;
        }
        Log::channel('adminlog')->info('AdminUsernameRule', [
            'end passes'
        ]);

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Username doesn\'t exit';
    }
}
