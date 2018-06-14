<?php

namespace App\Http\Requests;

use Dingo\Api\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'name' => ['required','string','min:4','max:255','regex:/^[a-zA-Z_0-9.@-_]+$/'],
            'password' => 'required|string|max:255',
        ];
    }
}
