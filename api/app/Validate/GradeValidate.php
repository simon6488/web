<?php
declare(strict_types=1);

namespace App\Validate;


use Inhere\Validate\Validation;

class GradeValidate extends Validation
{
    public function rules(): array
    {
        return [
            ['grade,term,type', 'required'],
            ['student_id', 'number', 'on' => 'store'],
            ['grade', 'in', [1, 2, 3, 4, 5, 6]],
            ['term', 'in', [1, 2]],
            ['type', 'in', ['a_first', 'a_second', 'a_third', 'a_fourth', 'a_mid', 'a_fifth', 'a_sixth', 'a_seventh', 'a_eighth', 'a_final', 'b_final']],
            ['point', 'float', 'on' => 'store'],
            ['file', 'array', 'on' => 'upload']
        ];
    }

    public function messages(): array
    {
        return [
            'grade.required' => '年级不能为空',
            'grade.in' => '年级必须是1-6',
            'term.required' => '学期不能为空',
            'term.in' => '学期类型错误',
            'type.required' => '成绩类型不能为空',
            'type.in' => '成绩类型错误',
            'student_id.number' => '学号格式错误',
            'point.float' => '成绩格式错误',
            'file.array' => '上传文件不能为空'
        ];
    }
}