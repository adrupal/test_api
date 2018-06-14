<?php

namespace App\Http\Requests;

use Dingo\Api\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => ['required','string','min:4','max:255','unique:users','regex:/^[a-zA-Z_0-9]+$/'],
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ];
    }

   /* public function attributes()
    {
        return [
            'name' => '用户名',
            'email' => '邮箱',
            'password' => '密码'
        ];
    }

    public function messages(){
        return [
            'name.required' => '请输入用户名',
            'email.required'  => '请输入邮箱地址',
        ];
    }*/
}
