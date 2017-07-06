<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;//开启验证后台登录
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
//        定义验证规则
        return [
            'email' => 'required|email',
            'password' => 'required|min:6|max:36|alpha_num',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => '邮箱不能为空',
            'email.email' => '邮箱格式不正确',
            'password.required' => '密码不能为空',
            'password.min' => '密码不能小于6位',
            'password.max' => '密码不能大于36位',
            'password.alpha_num' => '密码需要数字和字母组成',
        ];
    }
}
