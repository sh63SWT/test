<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUpRequest extends FormRequest
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
            'name' => 'required|min:2|max:12',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ];
    }

    public function messages()
    {
        return [
            'status.required' => '权限不能为空',
            'name.required' => '用户名不能为空',
            'name.min' => '用户名不能小于2位',
            'name.max' => '用户名不能大于12位',
            'email.required' => '邮箱不能为空',
            'email.email' => '邮箱格式不正确',
            'password.required' => '密码不能为空',
            'password.min' => '密码不能小于6位',
        ];
    }
}
