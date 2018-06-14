<?php

namespace App\Http\Requests;

use Dingo\Api\Http\FormRequest;

class AddressesPutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize( )
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
            'id' => 'required|integer|Exists:addresses',
            'type' => 'integer|between:1,2',
            'mobile' => ['string','regex:/1\d{10}/'],
            'addr_default' => 'integer|between:0,1',
        ];
    }
}
