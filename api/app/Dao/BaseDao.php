<?php
declare(strict_types=1);

namespace App\Dao;


use App\Model\User;

abstract class BaseDao
{
    /**
     * 创建记录
     * @param array $data
     * @return bool
     */
    abstract function create(array $data): bool;

    /**
     * 更新记录
     * @param array $data
     * @return bool
     */
    abstract function update(array $data): bool;

    /**
     * 获取单条记录
     * @param int $id
     * @return array
     */
    abstract function find(int $id): array;

    /**
     * 删除记录
     * @param int $id
     * @return bool
     */
    abstract function delete(int $id): bool;

    public function findUserByUsername(string $username): array
    {
        $model = User::query()->where('username', $username)->first();
        return $model ? $model->toArray() : [];
    }
}