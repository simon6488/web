<?php
declare(strict_types=1);

namespace App\Service\Impls;


abstract class BaseImpl
{
    /**
     * 新建记录
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
    abstract function findOne(int $id):array ;

    /**
     * 获取列表
     * @param array $data
     * @return array
     */
    abstract function findPaginate(array $data):array ;

    /**
     * 删除记录
     * @param int $id
     * @return array
     */
    abstract function delete(int $id):array ;
}