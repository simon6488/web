<?php
declare(strict_types=1);

namespace App\Validate;


use Inhere\Validate\Validation;

class SiteValidate extends Validation
{
    public function rules(): array
    {
        return [
            ['username,password', 'required'],
            ['username', 'string', 'filter' => 'trim'],
            ['password', 'string', 'filter' => 'trim']
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => '用户名不能为空',
            'password.required' => '密码不能为空'
        ];
    }

    protected function siteValidator(): bool
    {
        return true;
    }
}