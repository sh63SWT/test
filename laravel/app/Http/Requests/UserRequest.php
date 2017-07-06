<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
//        定义验证规则
        return [
            'name' => 'required|min:2',
            'email' => 'required|email',
            'birthday' => 'required',
            'phone' => 'required|digits:11',
            'password' => 'required|min:6',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => '邮箱不能为空',
            'name.required' => '用户名不能为空',
            'name.min' => '用户名至少2位',
            'birthday.required' => '生日不能为空',
            'email.email' => '邮箱格式不正确',
            'phone.required' => '*手机号不能为空',
            'phone.digits' => '*手机号要11位数字',
//            'phone.unique' => '*手机号重复',
//            'email.unique' => '*邮箱重复',
            'password.required' => '密码不能为空',
            'password.min' => '密码不能小于6位',
//            'password.alpha_num' => '密码需要数字和字母组成',
        ];
    }
}
