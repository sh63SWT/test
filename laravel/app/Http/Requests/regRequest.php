<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class regRequest extends FormRequest
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
            'phone' => 'required|digits:11|unique:users',
            'name' => 'required|min:2|max:12',
            'email' => 'required|email|unique:users',
            'password' => 'required|between:6,32|alpha_num',
            'repass' => 'required|between:6,32|alpha_num',
            'code' => 'required|between:4,4|alpha',
        ];
    }
    public function messages()
    {
        return [
            'phone.required' => '手机号不能为空',
            'phone.digits' => '手机号需要11位数字',
            'phone.unique' => '该手机号已被注册',
            'name.required' => '用户名不能为空',
            'name.min' => '用户名不能小于2位',
            'name.max' => '用户名不能大于12位',
            'email.required' => '邮箱不能为空',
            'email.email' => '邮箱格式不正确',
            'email.unique' => '邮箱已被使用',
            'password.required' => '密码不能为空',
            'password.between' => '密码长度6-32位',
            'password.alpha_num' => '密码需要数字和字母组成',
            'repass.required' => '密码不能为空',
            'repass.between' => '密码长度6-32位',
            'repass.alpha_num' => '密码需要数字和字母组成',
            'code.required' => '验证码不能为空',
            'code.between' => '验证码长度不符',
            'code.alpha' => '验证码只能是数字',
        ];
    }
}
