<?php

namespace App\Http\Requests;

use Dingo\Api\Http\FormRequest;

class AddressesPostRequest extends FormRequest
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
            'type' => 'required|integer|between:1,2',
            'mobile' => ['required','string','regex:/1\d{10}/'],
            'username' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address1' => 'required|string|max:255',
            'addr_default' => 'integer|between:0,1',
        ];
    }
}
