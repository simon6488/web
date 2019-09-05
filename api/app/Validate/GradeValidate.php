<?php
declare(strict_types=1);

namespace App\Validate;


use Inhere\Validate\Validation;

class GradeValidate extends Validation
{
    public function rules(): array
    {
        return [
            ['grade,term,type,file', 'required'],
            ['grade', 'number', 'in' => [1, 2, 3, 4, 5, 6]],
            ['term', 'number', 'in' => [1, 2]],
            ['type', 'string', 'in' => ['a_first', 'a_second', 'a_third', 'a_fourth', 'a_mid', 'a_fifth', 'a_sixth', 'a_seventh', 'a_eighth', 'a_final', 'b_final']],
            ['file', 'array']
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
            'file.required' => '上传文件不能为空'
        ];
    }
}