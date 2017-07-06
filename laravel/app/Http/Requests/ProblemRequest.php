<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProblemRequest extends FormRequest
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
            'problem' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'problem.required' => '答案不能为空',
        ];
    }
}
