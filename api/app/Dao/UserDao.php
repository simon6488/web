<?php
declare(strict_types=1);
/**
 * This file is part of Yunhu.
 * @link https://www.yunhuyj.com
 * @contact shunfei.xia@yunhuyj.com
 */

namespace App\Dao;


use App\Constants\ErrorCode;
use App\Exception\ApiException;
use App\Model\User;

class UserDao extends BaseDao
{
    public function create(array $data): bool
    {
        $user = new User($data);
        if (!$user->save()) {
            throw new ApiException(ErrorCode::DB_INSERT_FAILED);
        }
        return true;
    }

    public function update(array $data): bool
    {
        // TODO: Implement update() method.
    }

    public function find(int $id): array
    {
        // TODO: Implement find() method.
    }

    public function delete(int $id): bool
    {
        // TODO: Implement delete() method.
    }
}