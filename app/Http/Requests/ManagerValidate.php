<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManagerValidate extends FormRequest
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
            'account'=>'required|min:5|max:50|unique:admins,account',
            'password'=>'required|min:6|max:25|confirmed',
            'name'=>'required|min:2|max:15',
            'role_id'=>'required|numeric',
            'status'=>'filled',
        ];
    }

    public function messages()
    {
        return [
            'account.required' => '管理员登录帐户不得为空' ,
            'account.min' => '管理员登录帐户不得少于5个字符' ,
            'account.max' => '管理员登录帐户不得大于50个字符' ,
            'account.unique' => '管理员登录帐户不得重复' ,
            'password.required' => '管理员登录密码不得为空' ,
            'password.min' => '管理员登录密码不得少于6个字符' ,
            'password.max' => '管理员登录密码不得大于25个字符' ,
            'password.confirmed' => '管理员登录密码两次输入不一致' ,
            'name.required' => '管理员真实姓名不得为空' ,
            'name.min' => '管理员真实姓名不得少于2个字符' ,
            'name.max' => '管理员真实姓名不得大于15个字符' ,
            'role_id.required' => '所属管理角色信息有误' ,
            'role_id.numeric' => '所属管理角色信息有误' ,
            'status.filled' => '管理员帐户状态信息有误' ,
        ];
    }
}
