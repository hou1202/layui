<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginValidate extends FormRequest
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
            'account'=>'required|min:5|max:50',
            'password'=>'required|min:6|max:25',
        ];
    }

    public function messages()
    {
        return [
            'account.required' => '登录帐户不正确',
            'account.min' => '登录帐户不正确',
            'account.max' => '登录帐户不正确',
            'password.required' => '登录密码不正确',
            'password.min' => '登录密码不正确',
            'password.max' => '登录密码不正确',
        ];
    }
}
