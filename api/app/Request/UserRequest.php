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
                'app_id' => 'required|integer',
                'user_id' => 'required|integer',
            ],
            [
                'app_id.required' => '平台id不能为空',
                'app_id.integer' => '平台id必须为整数',
                'user_id.required' => '用户id不能为空',
                'user_id.integer' => '用户id必须为整数'
            ]
        );
        if ($validator->fails()) {
            throw new ApiException(ErrorCode::VALIDATE_ERROR, $validator->errors()->first());
        }
        return $data;
    }
}