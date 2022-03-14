<?php

namespace App\Http\Requests;

use App\Rules\AdminEditCheckName;
use App\Rules\OnlyDefinedOption;
use Illuminate\Foundation\Http\FormRequest;

class AdminEditValidation extends FormRequest
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

        return [
            'username' => ['required', 'min:8', 'max:16', new AdminEditCheckName()],
            'password' => ['required', 'min:8', 'max:16'],
            'role' => ['required', new OnlyDefinedOption()],
            'validate' => ['required']
        ];
    }
}
