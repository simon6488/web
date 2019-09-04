<?php
declare(strict_types=1);

namespace App\Validate;


use Inhere\Validate\Validation;

class StudentValidate extends Validation
{
    public function rules(): array
    {
        return [
            ['student_id,name,gender,status,contact', 'required'],
            ['student_id', 'number'],
            ['name', 'regexp', '/^[\x{4e00}-\x{9fa5}]{2,6}$/u'],
            ['gender', 'in', [1, 2]],
            ['status', 'in', [0, 1]],
            ['contact', 'regexp', '/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199|(147))\\d{8}$/']
        ];
    }

    public function messages(): array
    {
        return [
            'student_id.required' => '学号不能为空',
            'name.required' => '学生姓名能为空',
            'gender.required' => '学生性别不能为空',
            'status.required' => '学生状态不能为空',
            'contact.required' => '家长手机号不能为空',
            'student_id.number' => '学号必须大于0',
            'name.regexp' => '学生姓名必须是2-6个汉字',
            'contact.regexp' => '家长手机号格式不正确'
        ];
    }
}