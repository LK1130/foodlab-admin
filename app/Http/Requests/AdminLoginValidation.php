<?php

namespace App\Http\Requests;

use App\Rules\AdminPasswrodRule;
use App\Rules\AdminUsernameRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class AdminLoginValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        Log::channel('adminlog')->info('AdminLoginValidation', [
            'start rules'
        ]);

        Log::channel('adminlog')->info('AdminLoginValidation', [
            'end rules'
        ]);

        return [
            'username' => ['required', new AdminUsernameRule()],
            'password' => ['required', new AdminPasswrodRule()]
        ];
    }
}
