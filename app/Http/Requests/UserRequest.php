<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' =>['required','max:255'],
            'mail' => ['required|unique:users','max:255'],
            'profile'=>['required','max:255'],
            'image' =>[
                'file',
                'image',
                'mimes:jpg,jpg,png',
                'dimensions:min_width=50,min_height=50,
                 max_width=1000,max_height=1000',
                ]
        ];
    }
}
