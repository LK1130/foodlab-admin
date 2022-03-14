<?php

namespace App\Http\Requests;

use App\Rules\CheckFavourite;
use Illuminate\Foundation\Http\FormRequest;

class FavouriteValidation extends FormRequest
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
            'favourite_food' =>  ['required', 'min:0', 'max:30', new CheckFavourite()],
            'note' => 'required|min:0|max:255'
        ];
    }
}
