<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnswerRequest extends FormRequest
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

    public function rules()
    {
//        定义验证规则
        return [
            'answer' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'answer.required' => '问题不能为空',
        ];
    }
}
