<?php

namespace App\Http\Requests;

use App\Rules\CheckName;
use App\Rules\OnlyDefinedOption;
use Illuminate\Foundation\Http\FormRequest;


class AdminValidation extends FormRequest
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
    /*
    * Create:zayar(2022/01/10) 
    * Update: 
    * This is function is used to validate user request.
    */
    public function rules()
    {
        return [
            'username' => ['required', 'min:8', 'max:16', new CheckName()],
            'password' => ['required', 'min:8', 'max:16'],
            'role' => ['required', new OnlyDefinedOption()],
            'validate' => ['required']
        ];
    }
}
