<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdRequest extends FormRequest
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
            'status' => 'required',
            'name' => 'required|min:2|max:12|unique:admins',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6|max:36|alpha_num',
        ];
    }

    public function messages()
    {
        return [
            'status.required' => '权限不能为空',
            'name.required' => '用户名不能为空',
            'name.min' => '用户名不能小于2位',
            'name.max' => '用户名不能大于12位',
            'name.unique' => '用户名已被注册',
            'email.required' => '邮箱不能为空',
            'email.email' => '邮箱格式不正确',
            'email.unique' => '邮箱已被使用',
            'password.required' => '密码不能为空',
            'password.min' => '密码不能小于6位',
            'password.max' => '密码不能大于36位',
            'password.alpha_num' => '密码需要数字和字母组成',
        ];
    }
}
