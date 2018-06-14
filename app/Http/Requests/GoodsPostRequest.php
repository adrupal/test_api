<?php

namespace App\Http\Requests;

use Dingo\Api\Http\FormRequest;

class GoodsPostRequest extends FormRequest
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
            'brand_id' => 'required|integer',
            'en_title' => 'required|string|max:255',
            'cn_title' => 'required|string|max:255',
            'price' => 'required',
            'market_price' => 'required',
        ];
    }
}
