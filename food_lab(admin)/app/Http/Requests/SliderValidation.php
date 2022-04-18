<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderValidation extends FormRequest
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
            'title' => ['required', 'min:0', 'max:30'],
            'detail' => 'required|min:0|max:50',
            'buttonStatus' => ['required', 'integer', 'min:0', 'max:30'],
            'buttonText' => 'required|min:0|max:20',
            'buttonLink' => ['required', 'min:0', 'max:50'],
            'sliderImage' => 'required|min:0|max:255'

        ];
    }
}
