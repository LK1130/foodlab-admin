<?php

namespace App\Http\Requests;

use App\Rules\CheckTownship;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class TownshipValidation extends FormRequest
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
            'township_name' =>  ['required', 'min:4', 'max:16', new CheckTownship()],
            'dlprice' => 'required|min:0|max:5000|numeric',
            'note' => 'required|min:0|max:255'
        ];
    }
}
