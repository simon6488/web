<?php
declare(strict_types=1);

namespace App\Validate;

use Inhere\Validate\Validation;

class FileValidate extends Validation
{
    public function rules(): array
    {
        return [
            ['name,ext,size,tmp', 'required'],
            ['name', 'string', 'filter' => 'trim'],
            ['ext', 'string', 'in' => ['bmp', 'png', 'jpg', 'jpeg', 'xls', 'xlsx']],
            ['size', 'number', 'max' => 1024 * 1024 * 2]
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => '文件名不能为空',
            'ext.required' => '文件后缀名不能为空',
            'size.required' => '文件大小不能为空',
            'tmp.required' => '临时文件不能为空',
            'ext.in' => '文件格式不正确',
            'size.max' => '文件大小不能超过2M'
        ];
    }
}