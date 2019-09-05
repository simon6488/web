<?php
declare(strict_types=1);

namespace App\Service;

use App\Constants\ErrorCode;
use App\Exception\ApiException;
use App\Validate\FileValidate;

class FileService
{
    /**
     * 上传文件
     * @param array $file
     * @return string
     */
    public static function upload(array $file): string
    {
        $v = FileValidate::check($file);
        if ($v->isFail()) {
            throw new ApiException(ErrorCode::VALIDATE_ERROR, $v->firstError());
        }
        $file = $v->getSafeData();
        $fileName = '/uploads/' . md5($file['name'] . time()) . '.' . $file['ext'];
        if (!file_put_contents($fileName, $file['tmp'])) {
            throw new ApiException(ErrorCode::SERVER_ERROR, "上传失败");
        }
        return $fileName;
    }
}