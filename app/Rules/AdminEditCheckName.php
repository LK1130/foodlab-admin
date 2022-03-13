<?php

namespace App\Rules;

use App\Models\M_AD_Login;
use Illuminate\Contracts\Session\Session;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Log;

class AdminEditCheckName implements Rule
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

        $oldname = session('oldname');

        if ($oldname == $value) {
            return true;
        }
        $admin = M_AD_Login::where('ad_name', '=', $value)->where('del_flg', '=', 0)->get();
        if (count($admin) > 0) {
            Log::channel('adminlog')->info("LoginController", [
                $oldname . $value
            ]);
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Username already taken.';
    }
}
