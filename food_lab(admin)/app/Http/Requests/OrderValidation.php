<?php

namespace App\Http\Requests;

use App\Rules\CheckOrder;
use Illuminate\Foundation\Http\FormRequest;

class OrderValidation extends FormRequest
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
            'status' => ['required', 'min:0', 'max:30', new CheckOrder()],
            'note' => 'required|min:0|max:255'
        ];
    }
}
