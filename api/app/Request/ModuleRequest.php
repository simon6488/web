<?php
declare(strict_types=1);

namespace App\Request;


use App\Constants\ErrorCode;
use App\Exception\ApiException;

class ModuleRequest extends BaseRequest
{
    public function createValidate(array $data): array
    {
        $validator = $this->validatorFactory->make(
            $data,
            [
                'module_name' => 'required|string',
                'module_path' => 'required|string',
                'parent_id' => 'nullable|integer',
            ],
            [
                'module_name.required' => '模块名称不能为空',
                'module_path.required' => '模块路径不能为空',
                'parent_id.integer' => '模块父id必须是整数'
            ]
        );
        if ($validator->fails()) {
            throw new ApiException(ErrorCode::VALIDATE_ERROR, $validator->errors()->first());
        }

        if (isset($data['parent_id'])) {

        }
        return $data;
    }
}