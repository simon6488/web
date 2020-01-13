<?php
declare(strict_types=1);
/**
 * This file is part of Yunhu.
 * @link https://www.yunhuyj.com
 * @contact shunfei.xia@yunhuyj.com
 */

namespace App\Request;


use App\Constants\ErrorCode;
use App\Exception\ApiException;

class UserRequest extends BaseRequest
{
    public function loginValidate(array $data): array
    {
        $validator = $this->validatorFactory->make(
            $data,
            [
                'username' => 'required',
                'password' => 'required',
                ''
            ],
            [
                'username.required' => '账号不能为空',
                'password.required' => '密码不能为空',
            ]
        );
        if ($validator->fails()) {
            throw new ApiException(ErrorCode::VALIDATE_ERROR, $validator->errors()->first());
        }
        return $data;
    }

    /**
     * 新建用户验证
     * @param array $data
     * @return array
     */
    public function createValidate(array $data): array
    {
        $validator = $this->validatorFactory->make(
            $data,
            [
                'username' => 'required|alpha_dash|min:6|max:20',
                'password' => 'required|alpha_dash|min:6|max:20',
                'role_id' => 'required|integer',
            ],
            [
                'username.required' => '账号不能为空',
                'username.alpha_dash' => '账号必须是字母和数字,以及破折号和下划线',
                'username.min' => '账号长度不能小于6位',
                'username.max' => '账号长度不能大于20位',
                'password.alpha_dash' => '密码必须是字母和数字,以及破折号和下划线',
                'password.min' => '密码长度不能小于6位',
                'password.max' => '密码长度不能大于20位',
                'role_id.required' => '角色id不能为空',
                'role_id.integer' => '角色id必须为整数'
            ]
        );
        if ($validator->fails()) {
            throw new ApiException(ErrorCode::VALIDATE_ERROR, $validator->errors()->first());
        }
        return $data;
    }

    public function updateValidate(array $data): array
    {
        $validator = $this->validatorFactory->make(
            $data,
            [
                'nickname' => 'required|string',
                'password' => 'required|string|min:6|max:20',
                'mobile' => 'required|regexp:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199|(147))\\d{8}$/',
            ],
            [
                'nickname.required' => '昵称不能为空',
                'mobile.required' => '手机号不能为空',
                'mobile.regexp' => '手机号格式不正确',
                'user_id.integer' => '用户id必须为整数'
            ]
        );
        if ($validator->fails()) {
            throw new ApiException(ErrorCode::VALIDATE_ERROR, $validator->errors()->first());
        }
        return $data;
    }
}